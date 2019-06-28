<?php 

namespace Hcode;

use Rain\Tpl;

class Page 
{

    private $tpl;
    private $options = [];
    private $defaults = [
        "data" => []
    ];
    
    public function __construct ($opts = array())
    {

        //se o $opts for passado como parametro o array merge fará um mesclagem dos dados
        //o segundo parametro de array_merge sobrepõe o primeiro
        $this->options = array_merge($this->defaults, $opts);

        // config
        $config = array(
            "tpl_dir"       => $_SERVER["DOCUMENT_ROOT"] . "/views\/", //define o diretório das templates
            "cache_dir"     => $_SERVER["DOCUMENT_ROOT"] . "/views-cache\/", // define o ditretório de cache
            "debug"         => false // set to false to improve the speed
        );

        Tpl::configure( $config );

        // create the Tpl object
        $this->tpl = new Tpl;

        $this->setData($this->options["data"]);

        $this->tpl->draw("header");


    }


    private function setData($data = array())
    {

        //loop para registrar as variáveis que serão usadas no template
        foreach ($data as $key => $value) {
            $this->tpl->assign($key,$value);
        }

    }


    public function setTpl($name,$data = array(),$returnHtml = false)
    {

        $this->setData($data);

        return $this->tpl->draw($name,$returnHtml);

    }


    public function __desctruct()
    {
        
        $this->tpl->draw("footer");

    }

}


?>