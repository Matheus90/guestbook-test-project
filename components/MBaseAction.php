<?php


class MBaseAction {

    public function call($parameters){}

    public function render($viewName, $parameters = [], $layout = null){
        if( $layout === null )
            $layout = App::settings('defaultLayout');

        $path = ROOT.'/views/'.$viewName.'.php';

        if( (!$layout || file_exists($layout)) && file_exists($path) ){
            $content = $this->renderPartial($viewName, $parameters, true);

            if( $layout === false )
                exit($content);

            $cssFiles = $this->registeredCssFiles;
            $this->registeredCssFiles = [];
            $scriptFiles = $this->registeredScriptFiles;
            $this->registeredScriptFiles = [];

            $html = requireToVar($this, $layout, compact('content', 'cssFiles', 'scriptFiles'));

            exit($html);
        }
    }


    public function renderPartial($viewName, $parameters = [], $return = false){
        $path = ROOT.'/views/'.$viewName.'.php';

        if( !!$return )
            return requireToVar($this, $path, $parameters);
        else
            echo requireToVar($this, $path, $parameters);

        return true;
    }

    protected $registeredCssFiles = [];

    public function registerCssFile($fileName){
        if( !in_array($fileName, $this->registeredCssFiles) )
            array_push($this->registeredCssFiles, $fileName);
    }

    protected $registeredScriptFiles = [];

    public function registerScriptFile($fileName){
        if( !in_array($fileName, $this->registeredScriptFiles) )
            array_push($this->registeredScriptFiles, $fileName);
    }

}