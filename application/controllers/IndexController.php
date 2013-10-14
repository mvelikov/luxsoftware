<?php

class IndexController extends Zend_Controller_Action
{

    public function indexAction()
    {

        $request = $this->getRequest();
        $form = new Form_Request();

        if ($request->isPost())
        {
            $postData = $request->getPost();
            if ($form->isValid($postData))
            {
                $validValues = $form->getValues();
                $stringMessage = 'From: '.$validValues['name'].' <br/>';
                $stringMessage .= 'Email: '.$validValues['email'].' <br/>';
                $stringMessage .= 'Message: '.$validValues['message'].' <br/>';
                $this->_sendEmail('radoslav.borissov@gmail.com', 'Form Lux Software', $stringMessage);
                $this->_sendEmail('mihailvelik@gmail.com', 'Form Lux Software', $stringMessage);
                $this->view->message = 'Thank you!';
            }
            else
            {
                $form->populate($postData);
            }
        }
        $this->view->form = $form->render();

        /* Initialize SEO shits controller here */
        $this->view->headTitle($this->view->translate('Web Development | Mobile Development | Cloud Solutions | CRM & ERP Systems | iOS Development'), 'APPEND');
        $this->view->headMeta()->setName('description', 'Web Developlment and mobile development');
        $this->view->headMeta()->setName('keywords', 'Websites, Web development, Mobile development, Design, Database Applications');
    }

    protected function _sendEmail($toEmail, $subject, $message)
    {
        $mail = new Zend_Mail('UTF-8');
        $mail->setFrom("automotivemailer@luxbulgaria.net", "Lux Software");
        $mail->setBodyHtml($message);
        $mail->addTo($toEmail, 'recipient');
        $mail->setSubject($subject);
        $mail->setHeaderEncoding(Zend_Mime::ENCODING_BASE64);
        $mail->send();
    }

}

