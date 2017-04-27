<?php

/**
 * Email [Model]
 * Descricao
 * 
 */
class Email {
   
    /** @var PHPMailer */
    
    private $mail;
    
    /** Email DATA */
    private $data;
    
    /** Corpo de email */
    private $assunto;
    private $mensagem;
    
    /** Remetente */
    private $remetenteNome;
    private $remetenteEmail;
    
    /** Destino */
    private $destinoNome;
    private $destinoEmail;
    
    /** Controle */
    private $error;
    private $result;
    
    function __construct() {
        $this->mail = new PHPMailer;
        $this->mail->Host = MAILHOST;
        $this->mail->Port = MAILPORT;
        $this->mail->Username = MAILUSER;
        $this->mail->Password = MAILPASS;
        $this->mail->CharSet = "UTF-8";
    }
    
    public function Enviar(array $data) {
        $this->data = $data;
        $this->Clear();
        
        if(in_array('', $this->data)){
            $this->error = ["Existem campos não preenchidos no formulário! Por favor preencha todos os campos!", WS_ALERT];
            $this->result = false;
        }
        else if(!Check::Email($this->data["remetente_email"])){
            $this->error = ["Email inválido, por favor entre com seu email!", WS_ERROR];
            $this->result = false;            
        }
        else{
            $this->SetMail();
            $this->Config();
            $this->SendMail();
        }
    }
    
    public function getError() {
        return $this->error;
    }

    public function getResult() {
        return $this->result;
    }

        
    private function Clear() {
        array_map('strip_tags', $this->array);
        array_map('trim', $this->data);
    }
    
    private function SetMail() {
        $this->assunto = $this->data['assunto'];
        $this->mensagem = $this->data['mensagem'];
        $this->remetenteNome = $this->data['remetente_nome'];
        $this->remetenteEmail = $this->data['remetente_email'];
        $this->destinoNome = $this->data['destino_nome'];
        $this->destinoEmail = $this->data['destino_email'];
        $this->assunto = $this->data['assunto'];
        
        $this->data = null;
        $this->SetMensagem();
    }
    
    private function SetMensagem() {
        $this->mensagem = "{$this->mensagem}<hr><small>Recebida em: " . date('d/m/Y H:i') . "</small>";
    }
    
    private function Config() {
        //SMTP AUTH
        $this->mail->isSMTP();
        $this->mail->isHTML();
        $this->mail->SMTPAuth = true;
        
        //Remetente e retorno
        $this->mail->From = MAILUSER;
        $this->mail->From = $this->remetenteNome;
        $this->mail->addReplyTo($this->remetenteEmail, $this->remetenteNome);
        
        //Assunto, mensagem e destino
        $this->mail->Subject = $this->assunto;
        $this->mail->Body = $this->mensagem;
        $this->mail->addAddress($this->destinoEmail, $this->destinoNome);
    }
    
    private function SendMail() {
        if($this->mail->send()){
            $this->error = ['Obrigado por entrar em contato: Recebemos sua mensagem e entraremos em contatos com você!', WS_ACCEPT];
            $this->result = true;
        }else{
            $this->error = ["Falha ao enviar: Entre em contato com o admin! ({$this->mail->ErrorInfo})", WS_ACCEPT];
            $this->result = true;            
        }
    }
    
}
