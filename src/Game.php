<?php

namespace AndrewFeeney\Phlappy;

use Chewie\Concerns\RegistersRenderers;
use Chewie\Concerns\SetsUpAndResets;
use Chewie\Input\KeyPressListener;
use Laravel\Prompts\Prompt;

class Game extends Prompt
{
    use RegistersRenderers;
    use SetsUpAndResets;

    public function __construct()
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
            ->listenForQuit();

        while (true) {
            $listener->once();

            $this->render();

            usleep(2_000);
        }
    }
}
