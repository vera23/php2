<?php

namespace App;


class View implements \Countable
{
    use TMagic;

    public function render($template)
    {
        ob_start();
        foreach ($this->data as $prop => $value) {
            $$prop = $value;
        }
        include $template;
        $content = ob_get_contents();
        ob_clean();
        return $content;

    }

    /**
     * подключает необходимый шаблон
     * @param string $template путь к шаблону
     */
    public function display(string $template)
    {
        echo $this->render($template);
    }

    public function count()
    {
        return count($this->data);
    }


}