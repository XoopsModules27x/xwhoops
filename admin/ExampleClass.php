<?php declare(strict_types=1);

defined('XOOPS_ROOT_PATH') || exit('XOOPS root path not defined');

class ExampleClass
{
    /** @var string */
    private string $msg;

    public function __construct(string $msg)
    {
        $this->msg = $msg;
    }

    public function flawedMethod(): void
    {
        try {
            new \NoSuchClass($this->msg);
        } catch (Throwable $e) {
            throw new RuntimeException('Example Exception, follow how we got here.', 100, $e);
        }
    }
}
