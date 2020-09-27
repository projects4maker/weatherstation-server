<?php
/**
 * raah @ projects4maker.com
 * 
 * Weatherstation project server source
 * 
 * @see projects4maker.com/weatherstation
 */

namespace App;
use App\Exception\TerminateException as TException;

class FileLoader {

    private $source = '';

    public function __construct($file = '') {

        $this->source = $file;

        if(!is_readable($this->source) || !is_file($this->source)) {

            throw new TException("Invalid include source: ". $this->source);
        }
    }

    public function include() {

        ob_start();

        require $this->source;

        $content = ob_get_contents();

        ob_end_clean();

        return $content;
        
    }
}