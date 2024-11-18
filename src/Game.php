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

    private Grid $grid;

    public function __construct()
    {
        $this->registerRenderer(Renderer::class);

        $bird = new Sprite(['__o>__']);

        $initalHeight = $this->terminal()->lines();
        $initialWidth = $this->terminal()->cols();

        $bird->move(
            x: floor(($initialWidth - 5) / 2),
            y: floor(($initalHeight - 1) / 2),
        );

        $this->grid = new Grid([$bird]);

        $this->setup($this->run(...));
    }

    public function value(): mixed
    {
        return null;
    }

    public function grid(): Grid
    {
        return $this->grid;
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
