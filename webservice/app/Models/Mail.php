<?php

include(__DIR__."/Base/MailBase.php");

include($magrathea_path."/Magrathea/Email.class.php");

class Mail extends MailBase {
	public function Send(){
		$replyTo = ( empty ($this->replyto) ) ? $this->from : $this->replyto;
		if( !filter_var($this->from, FILTER_VALIDATE_EMAIL) ){
			$content["error"] = "E-mail de envio inválido!";
			$content["success"] = false;
		} else {
			$email = new MagratheaEmail();
			$email->setNewEmail($this->to, $this->from, $this->subject);
			$email->setMessage($this->message);
			p_r($email);

			if( $email->send() ){ 
				$content["success"] = "true";
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

class MailControl extends MailControlBase {
	public static function getEmailToSend(){
		$q = MagratheaQuery::Select()
			->Obj(new Mail())
			->Where(array("sent_status" => 0))
			->OrderBy("priority DESC")
			->OrderBy("add_date DESC")
			->Limit(1);
		return self::RunRow($q->SQL());
	}
}

?>