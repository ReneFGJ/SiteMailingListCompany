<?php
    /**
     * Header
	 * @author Rene Faustino Gabriel Junior <renefgj@gmail.com> (Analista-Desenvolvedor)
	 * @copyright Copyright (c) 2011 - sisDOC.com.br
	 * @access public
     * @version v0.14.02
	 * @package Library
	 * @subpackage E-mail
    */
    
class email
	{
		var $user_email='';
		var $user_name='';
		var $user_password='';
		
		var $to_email;
		var $to_name;
		
		var $replay_email;
		var $replay_name;
		
		var $header;
		var $subject;
		var $message;
		var $priority=0;
		
		var $monitor=0;
		var $method='A'; /* A-Authenticado; N-Sem autenticar */
		
		function cab($assunto,$texto)
			{
				global $dd,$acao,$email;
				$sx .= '<table width="100%" class="noprint">
						<TR><TD><form method="get" action="'.page().'">
						<TD><input type="hidden" name="dd0" value="'.$dd[0].'">
						    <input type="hidden" name="dd1" value="'.$dd[1].'">
						    <input type="hidden" name="dd2" value="'.$dd[2].'">
						    <input type="hidden" name="dd3" value="'.$dd[3].'">
						    <input type="hidden" name="dd4" value="'.$dd[4].'">
						    <input type="hidden" name="dd5" value="'.$dd[5].'">
						    <input type="hidden" name="dd6" value="'.$dd[6].'">
						    <input type="hidden" name="dd90" value="'.$dd[90].'">
						    <input type="hidden" name="dd91" value="'.$dd[91].'">
						    <input type="hidden" name="acao" value="'.$acao.'">
						<TD>
							e-mail: 
							<input type="text" style="width: 280px;" size="30" name="dd50" value="'.$dd[50].'">
							<input type="submit" class="bt" name="dd51" value="enviar por e-mail">
						<TD>
							</form>
						<TD align="right">
							<input type="button" value="imprimir" class="bt" onclick="window.print();">
						</table>';
						
				if (($this->email_check($dd[50]) == 1) and (strlen($dd[51]) > 0))
					{
						$email->enviar_email($dd[50],$assunto,$texto);
						$sx .= '<table width="100%" class="noprint">
								<TR><TD><font color="blue">E-mail enviado com sucesso para '.$dd[50].'</font>
							   </table>
						';
					}
				return($sx);						
			}
		
		function enviar_email($to='',$subject='',$messagem='',$to_name='')
			{
				$this->to_email = $to;
				$this->to_name = $to_name;
				$this->subject = $subject;
				$this->message = $messagem;
				
				$this->method_autenticado();
				return(1);
			}
			
		function method_mail()
			{
				$to = $this->to;
				$subject = $e3;
				$body = $e4;
				
				$headers = $this->header();

				if (mail($to, $this->subject, $body, $headers)) {
	   				return('OK');
	 			} else {
	  				return('ERRO');
	  			}
			}
		/*
		 * Format the e-mail
		 */
		function format_email($email,$name)
			{
				$name=trim($name);
				$email=trim($email);
				if (strlen($name) > 0)
					{
						$sx = $name.' <'.$email.'>';						
					} else {
						$sx = $email;
					}
				return($sx);
			}
			
		/*
		 * Header e-mail
		 */
		function header()
			{
				$headers .= "To: ".$this->format_email($this->to_email,$this->to_name)." \n";
				$headers .= "From: ".$this->format_email($this->from_email,$this->from_name)." \n";
				$headers .= "Mime-Version: 1.0 \n";
			//	$headers .= "Priority: Normal \n";
			//	$headers .= "Reply-To: " .$email_adm. " \n";
			//	$headers .= "Return-Path: ".$email_adm." \n";
				$headers .= "Subject: ".$this->subject." \n";
			//	$headers .= "X-Assp-Envelope-From:".$email_adm." \n";
				$headers .= 'Content-Type: text/html; charset="iso-8859-1"'." \n";		
				
				$headers = '';
				$headers .= "MIME-Version: 1.0\n" ;
				$headers .= "To: ".$this->format_email($this->to_email,$this->to_name)." \n";
				if (strlen($this->replay_email) > 0)
					{
						$headers .= "Reply-To: ".$this->format_email($this->replay_email,$this->replay_name)." \n";						
					} else {
						$headers .= "Reply-To: ".$this->format_email($this->from_email,$this->from_name)." \n";		
					}
				
				$headers .= "Content-type: text/html; charset=iso-8859-1\n";	
				
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";	
				return($headers);				
			}
			
		function method_autenticado()
			{
				restore_error_handler();
				ini_set('display_errors', 0);
				ini_set('error_reporting', 0);
				$usuario = $this->user_email;
			 	$senha = $this->user_password;
				
				$assunto = $this->subject; 				
 				$nomeDestinatario = trim($this->to_name);
				
				if (strlen($this->replay_name) > 0)
					{
						$Remetente_email = trim($this->replay_email);
						$Remetente_name = trim($this->replay_name);
					} else {
						$Remetente_email = trim($this->user_email);
						$Remetente_name = trim($this->user_name);		
					}
			//
			$destinatarios = $this->to_email;
 			$tela .= 'xx(tela)';			
 			$resposta .= $Remetente_email;			
			$headers = $this->header();
			$mensagem = $this->message.'</B>';
			if ($this->monitor==1)
				{
					echo '<fieldset><legend>Usu�rio que envia</legend>';
					echo $usuario.' '.$senha;
					echo '</fieldset>';
					echo '<BR>From: '.$Remetente_name.' &lt;'.$Remetente_email.'>';
					echo '<BR>To:'.$nomeDestinatario.' &lt;'.$destinatarios.'>';
				}
 			$_POST['mensagem'] = nl2br($message);
			 
 			/***********************************A PARTIR DAQUI NAO ALTERAR************************************/
				foreach ($_POST as $dados['me1'] => $dados['me2'])
				{ $dados['me3'][] = '<b>'.$dados['me1'].'</b>: '.$dados['me2']; }
			
				$dados['me3'] = $mensagem;
				$dados['email'] = array(
								'usuario' => $usuario, 
								'senha' => $senha, 
								'servidor' => 'smtp.'.substr(strstr($usuario, '@'), 1), 
								'nomeRemetente' => $Remetente_name, 
								'nomeDestinatario' => $nomeDestinatario, 
								'resposta' => $resposta, 
								'assunto' => $assunto, 
								'mensagem' => $dados['me3']);
				
				/* Inicializa��o */
				ini_set('php_flag mail_filter', 0);
				$conexao = fsockopen($dados['email']['servidor'], 587, $errno, $errstr, 10) or die("<font color='red'>ERRO DE ENVIO!</font>");
				fgets($conexao, 512);
				$dados['destinatarios'] = explode(',', $destinatarios);
				/* RCPTTO */
				foreach ($dados['destinatarios'] as $dados['1'])
				{
					$dados['destinatarios']['RCPTTO'][] = '< '.$dados['1'].' >';
					$dados['destinatarios']['TO'][] = $dados['1'];
				}
				/* EHLO */
				$dados['cabecalho'] = array(
						'EHLO ' => $dados['email']['servidor'], 
						'AUTH LOGIN', base64_encode($dados['email']['usuario']), 
						base64_encode($dados['email']['senha']), 
						'MAIL FROM: ' => '< '.$dados['email']['usuario'].' >', 
						'RCPT TO:' => $dados['destinatarios']['RCPTTO'], 
						'DATA', 
						'MIME-Version: ' => '1.0', 
						'Content-Type: text/html; charset=iso-8859-1', 
						'Date: ' => date('r',time()), 
						'From: ' => array($dados['email']['nomeRemetente'].' ' => '< '.$dados['email']['usuario'].' >'), 
						'To:' => array($dados['email']['nomeDestinatario'].' ' => $dados['destinatarios']['TO']), 
						'Reply-To: ' => $dados['email']['resposta'],
						'Subject: ' => $dados['email']['assunto'], 
						'mensagem' => $dados['email']['mensagem'], 
						'QUIT');
				foreach ($dados['cabecalho'] as $dados['2'] => $dados['3'])
				{
					if (is_array($dados['3']))
					{ foreach ($dados['3'] as $dados['4'] => $dados['5']) {
						$dados['4'] = empty($dados['4']) ? '' : $dados['4'];
						$dados['5'] = empty($dados['5']) ? '' : $dados['5'];
						$dados['4'] = is_numeric($dados['4']) ? '' : $dados['4'];
						if (is_array($dados['5']))
							{ $dados['5'] = "< ".implode(', ', $dados['5'])." >"; }
						fwrite($conexao, $dados['2'].$dados['4'].$dados['5']."\r\n", 512).'<br>';
							fgets($conexao, 512);
					}
				} else {
				$dados['2'] = empty($dados['2']) ? '' : $dados['2'];
				$dados['3'] = empty($dados['3']) ? '' : $dados['3'];
				$dados['2'] = is_numeric($dados['2']) ? '' : $dados['2'];
				
				if ($dados['2'] == 'Subject: ')
				{
					fwrite($conexao, $dados['2'].$dados['3']."\r\n", 512).'<br>';
					fwrite($conexao, "\r\n", 512).'<br>';
					fgets($conexao, 512);
				} elseif ($dados['2'] == 'mensagem') 
					{
						fwrite($conexao, $dados['3']."\r\n.\r\n").'<br>';
						fgets($conexao);
					} else {
						fwrite($conexao, $dados['2'].$dados['3']."\r\n", 512).'<br>';
						fgets($conexao, 512);
					}
				}
				//print_r($dados);
				//echo '<HR>';
			}
			fclose($conexao);
			return(1);	
		}
			
		function email_check($chemail)
			{
			$result = count_chars($chemail, 0);
			if (($result[64] == 1)  and ($result[32] == 0) and ($result[32] == 0) and ($result[13] == 0) and ($result[10] == 0))
				{
				$xerr = True; 
				
				if (strpos($chemail,'!')) { $xerr = False; }
				if (strpos($chemail,'@.')) { $xerr = False; }
				}
			else
				{$xerr = False; }
				
			if ($chemail[strlen($chemail)-1] < 'a') { $xerr = false; }
			return($xerr);
			}			
	}
	