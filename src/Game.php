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
    private array $pipes;

    public function __construct()
    {
        $this->registerRenderer(Renderer::class);

        $initialHeight = $this->terminal()->lines();
        $initialWidth = $this->terminal()->cols();

        $this->bird = new Bird($initialWidth, $initialHeight);
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

        $pipe->move($initialWidth + $pipe->width(), -$initialHeight + 3);
        $this->pipes = [$pipe];

        $this->grid = new Grid([$this->bird, ...$this->pipes]);

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

        $tick = 0;

        while (true) {
            $tick++;
            $listener->once();

            $this->render();

            $this->bird->fall();

            foreach ($this->pipes as $pipe) {
                if ($tick % 4 === 0) {
                    $pipe->move(-1, 0);
                }
            }

            usleep(2_000);
        }
    }
}
