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
    private Bird $bird;
    private array $pipes = [];
    private int $tick = 0;

    public function __construct()
    {
        $this->registerRenderer(Renderer::class);

        $initialHeight = $this->terminal()->lines();
        $initialWidth = $this->terminal()->cols();

        $this->bird = new Bird($initialWidth, $initialHeight);

        $this->grid = new Grid([$this->bird]);

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

    public function pipes(): array
    {
        return $this->pipes;
    }

    public function bird(): Bird
    {
        return $this->bird;
    }

    public function run()
    {
        $listener = KeyPressListener::for($this)
            ->onLeft(fn () => $this->bird->move(1, 0))
            ->onRight(fn () => $this->bird->move(-1, 0))
            ->onUp(fn () => $this->bird->flap())
            ->on(' ', fn () => $this->bird->flap())
            ->listenForQuit();

        while (true) {
            $this->tick++;
            $listener->once();

            $this->render();

            $this->bird->fall();

            $this->handlePipes();

            usleep(2_000);
        }
    }

    private function handlePipes()
    {
        if (count($this->pipes) < 1) {
            $pipe = new Sprite([
                '___________',
                '|         |',
                '|_________|',
                ' ||     ||',
                ' ||     ||',
                ' ||     ||',
                ' ||     ||',
                ' ||     ||',
                ' ||     ||',
            ]);

            $pipe->move($this->terminal()->cols() + $pipe->width(), -$this->terminal()->lines() + 3);
            $this->pipes[] = $pipe;
            $this->grid->addRenderable($pipe);
        }

        foreach ($this->pipes as $index => $pipe) {
            if ($this->tick % 4 === 0) {
                $pipe->move(-1, 0);
            }

            if ($pipe->xOffset() - $pipe->width() > 0) {
                $this->grid->removeRenderable($pipe);
                unset($this->pipes[$index]);
            }
        }

        $this->pipes = array_values($this->pipes);
    }
}
