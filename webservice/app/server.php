<?php

require("inc/global.php");
include($magrathea_path."/Magrathea/MagratheaServer.php");

//error_reporting(E_ALL ^ E_STRICT);

include("Models/Email.php");
include("Models/Source.php");

class ContactServer extends MagratheaServer{

	public function getSources(){
		$sources = SourceControl::GetAll();
		$this->Json($sources);
	}

	/**
	*
	*	source = id da source a ser enviada
	*	to = email "to"
	*	from = email "from" (optional)
	*	replyTo = email "replyTo" (optional)
	*	subject = assunto do email
	*	message = mensagem
	*	priority = prioridade
	*
	*/
	public function addMail(){

		$data = $_POST;
		$source = new Source($_POST["source"]);
		$mail = new Email();
		$mail->source_id = $source->id;
		$mail->from = (empty($_POST["from"])) ? "".$source->name." <".$source->from.">" : $_POST["from"];
		$mail->to = $_POST["to"];
		$mail->replyto = @$_POST["replyto"];
		$mail->subject = $_POST["subject"];
		$mail->message = $_POST["message"];
		$mail->priority = $_POST["priority"];
		$mail->content_type = (empty($_POST["content_type"])) ? 'text/plain' : $_POST["content_type"];
		$mail->add_date = now();
		$mail->sent_status = 0;

		if(!empty($mail->email_to)){
			$mail_id = $mail->Insert();
			MagratheaLogger::Log("<---< Mail inserted: [id: ".$mail_id.", to: ".$mail->to."] <---<");
			$this->Json($mail);
		} else {
			$this->Json(false);
		}
	}

	public function sendMail(){
		$mail = EmailControl::getEmailToSend();
		if(!$mail) die("no mail to send...");
		$response = $mail->Send();
		if($response["success"]) {
			MagratheaLogger::Log(">===> Sending mail: [id: ".$mail->id.", to: ".$mail->to."] >===>");
		} else {
			$priority = $mail->priority;
			$priority --;
			$mail->priority = ($priority > 0) ? $priority : 0;
			$mail->Save();
			MagratheaLogger::Log(">===> Error mail: [id: ".$mail->id.", to: ".$mail->to."] >=> [".$reponse["error"]."] >===>");
		}
		$this->Json($response);
	}

	public function showSources(){
		header('Content-type: text/html; charset=utf-8');
		SourceControl::showAll();
	}
	public function showMails(){
		header('Content-type: text/html; charset=utf-8');
		EmailControl::showAll();
	}

}

$server = new ContactServer();
$server->Start();


// cron job:
//
//	*/30 * * * * wget --delete-after -q http://contato.paulovelho.com.br/server.php?sendMail 
//



?>


