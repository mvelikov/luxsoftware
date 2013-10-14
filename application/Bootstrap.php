<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    protected function _initAutoload()
    {
        if (APPLICATION_ENV == 'production')
        {
            if ($_SERVER['SERVER_NAME'] != 'luxsoftware.net')
            {
                header('Location: http://luxsoftware.net/');
                exit;
            }
        }
        ini_set('date.timezone', 'Europe/Sofia');
        ini_set('default_charset', 'UTF-8');
        mb_internal_encoding('UTF-8');
        $autoloader = new Zend_Loader_Autoloader_Resource(array('namespace' => '', 'basePath' => APPLICATION_PATH));
        $autoloader->addResourceType('Model', '/models', 'Model');
        $autoloader->addResourceType('Form', '/forms', 'Form');
        $autoloader->addResourceType('LuxSoftware', '../library/LuxSoftware', 'LuxSoftware');
        return $autoloader;
    }

    protected function _initLayoutView()
    {
        //    $this->_siteCinfiguraion = new Zend_Config_Ini(APPLICATION_PATH . '/configs/config.ini', APPLICATION_ENV);
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->doctype('HTML5');

        $view->headLink()->appendStylesheet('//fonts.googleapis.com/css?family=Maven+Pro:700,900|Open+Sans:300italic,400italic,600italic,400,300,600', 'all');
        $view->headLink()->appendStylesheet('/resources/styles.css', 'all');
        $view->headLink()->appendStylesheet('/resources/960.css', 'all');

        $view->headScript()->prependFile('//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js');
        $view->headScript()->appendFile('/resources/main.js');
//   $view->headLink()->appendAlternate('/rss/show/channel/news/', 'application/rss+xml', 'Automotive ' . $view->escape($view->translate('Новини')));
        //     $view->headScript()->prependFile($this->_siteCinfiguraion->site->jquery);
        //   $view->headScript()->appendFile('/js/main.js');
        $view->headTitle('Lux Software')->setSeparator(' : ');
        //    $view->headLink()->appendStylesheet('/css/style.css', 'all');
        $view->headLink(array('rel' => 'SHORTCUT ICON', 'href' => '/favicon.ico'), 'PREPEND');
        //   $view->headMeta()->appendHttpEquiv('Content-Type', 'text/html;charset=utf-8');
        //   $view->addHelperPath(APPLICATION_PATH . '/views/helpers', 'LuxSoftware_View_Helper_');
        return $view;
    }
    
        protected function _initEmailTransport()
    {
        $config = array(
            'auth' => 'login',
            'username' => "automotivemailer@luxbulgaria.net",
            'password' => 'qweasd123'
        );
        $mailTransport = new Zend_Mail_Transport_Smtp('luxbulgaria.net', $config);
        Zend_Mail::setDefaultTransport($mailTransport);
    }

}

