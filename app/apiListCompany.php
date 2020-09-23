<?php

class apiListCompany
{
    public function open($requisicao)
    {
            $url = explode('/', $_REQUEST['url']);
            $classe = $url[0];
    }
}

if (isset($_REQUEST)) {
    apiListCompany::open($_REQUEST);
}
