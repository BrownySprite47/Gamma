<?php

class ErrorHandler
{
    protected $errors = [
        E_ERROR => 'E_ERROR',
        E_WARNING => 'E_WARNING',
        E_PARSE => 'E_PARSE',
        E_NOTICE => 'E_NOTICE',
        E_CORE_ERROR => 'E_CORE_ERROR',
        E_CORE_WARNING => 'E_CORE_WARNING',
        E_COMPILE_ERROR => 'E_COMPILE_ERROR',
        E_COMPILE_WARNING => 'E_COMPILE_WARNING',
        E_USER_ERROR => 'E_USER_ERROR',
        E_USER_WARNING => 'E_USER_WARNING',
        E_USER_NOTICE => 'E_USER_NOTICE',
        E_STRICT => 'E_STRICT',
        E_RECOVERABLE_ERROR => 'E_RECOVERABLE_ERROR',
        E_DEPRECATED => 'E_DEPRECATED',
        E_USER_DEPRECATED => 'E_USER_DEPRECATED',
    ];

    protected $debug;

    public function __construct($debug)
    {
        $this->debug = (bool)$debug;
        if ($this->debug) {
            ini_set("display_errors", "on");
            error_reporting(E_ALL);
            ini_set('html_errors', 'on');
        } else {
            ini_set("display_errors", "off");
            error_reporting(0);
            ini_set('html_errors', 'off');
        }
        //error_reporting($this->debug ? -1 : 0);
        set_error_handler([$this, 'errorHandler']);
        ob_start();
        register_shutdown_function([$this, 'fatalErrorHandler']);
        set_exception_handler([$this, 'exceptionErrorHandler']);
    }

    /**
     * @return array
     */
    public function errorHandler($errno, $errstr, $errfile, $errline)
    {
        $this->displayError($this->errors[$errno], $errstr, $errfile, $errline);
//        die();
    }
    /**
     * @return array
     */
    public function fatalErrorHandler()
    {
        $error = error_get_last();

        if ($error && $error['type'] & (E_ERROR | E_PARSE | E_COMPILE_ERROR | E_COMPILE_ERROR)) {
            ob_end_clean();

            $this->displayError($this->errors[$error['type']], $error['message'], $error['file'], $error['line']);
        } else {
            ob_end_flush();
        }
    }
    /**
     * @return array
     */
    public function displayError($errno, $errstr, $errfile, $errline, $response = 500)
    {
        error_log(
            '[' . date('Y-m-d H:i:s') . '] ' . $errno . ' - ' . $errstr . ' - ' . $errfile . '(' . $errline . ')' . "\n",
            3,
            __DIR__ . '/errors.log'
        );
        http_response_code($response);
        if ($this->debug) {
            var_dump($errno, $errstr, $errfile, $errline);
        } else {
            renderView('index/errors/500/index/index/index');
        }
    }

    /**
     * @param  \Exception
     * @return array
     */
    public function exceptionErrorHandler(\Exception $e)
    {
        $this->displayError($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
    }
}
