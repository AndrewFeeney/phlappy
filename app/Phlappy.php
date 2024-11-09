<?php

namespace App;

use Chewie\Concerns\RegistersRenderers;
use Chewie\Concerns\SetsUpAndResets;
use Chewie\Input\KeyPressListener;
use Laravel\Prompts\Prompt;

class Phlappy extends Prompt
{
    use RegistersRenderers;
    use SetsUpAndResets;

    public function __construct(private Bird $bird)
    {
        $this->registerRenderer(Renderer::class);

        $this->setup($this->run(...));
    }

    public function value(): mixed
    {
        return null;
    }

    public function run()
    {
        $listener = KeyPressListener::for($this)
            ->on(' ', fn () => $this->bird->flap())
            ->onUp(fn () => $this->bird->ascend())
            ->onDown(fn () => $this->bird->descend())
            ->listenForQuit();

        while (true) {
            $listener->once();

            $this->render();
        }
    }


    public function bird(): Bird
    {
        return $this->bird;
    }
}
