<?php

include(__DIR__."/Base/EmailBase.php");

include($magrathea_path."/Magrathea/Email.class.php");

class Email extends EmailBase {
	public function Send(){
		if( !filter_var($this->to, FILTER_VALIDATE_EMAIL) ){
			$content["error"] = "E-mail de envio inválido!";
			$content["success"] = false;
		} else {
			$email = new MagratheaEmail();
			$email->setNewEmail($this->to, $this->from, $this->subject);
			if( !empty($this->email_replyto) ){
				$email->setReplyTo($this->replyto);
			}
			if( strtolower($this->content_type) == "text/html"){
				$email->setHTMLMessage($this->message);
			} else {
				$email->setTXTMessage($this->message);
			}
			if( $email->send() ){ 
				$content["success"] = "true";
				$content["mailto"] = $this->to;
				$this->sent_status = 1;
				$this->sent_date = now();
				$this->Save();
			} else { 
				$content["error"] = $email->getError();
				$content["success"] = false;
			}
		}
		return $content;

	}
}

class EmailControl extends EmailControlBase {
	// and here!
	public static function getEmailToSend(){
		$q = MagratheaQuery::Select()
			->Obj(new Email())
			->Where(array("sent_status" => 0))
			->OrderBy("priority DESC, add_date ASC")
			->Limit(1);
		return self::RunRow($q->SQL());
	}
}

?>