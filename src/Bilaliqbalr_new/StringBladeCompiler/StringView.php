<?php
namespace Bilaliqbalr_new\StringBladeCompiler;

use Illuminate\Support\Facades\Log;
use View;
use Closure;
use ArrayAccess;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Renderable;

class StringView extends \Illuminate\View\View implements ArrayAccess, Renderable
{

    /** @var \Illuminate\Config\Repository */
    protected $config;

    public function __construct($config)
    {
        Log::info('asdasdasd8a8asd8a8sdasd');
        $this->config = $config;
    }

    public function setEngine($compiler)
    {
        Log::info('asdasdasd8a8asd8a8sdasd22222222222222222222222222222');
        $this->engine = $compiler;
        return $this;
    }

    /**
     * Get a evaluated view contents for the given view.
     *
     * @param  string  $view
     * @param  array   $data
     * @param  array   $mergeData
     * @return \Illuminate\View\View
     */
    public function make($view, $data = array(), $mergeData = array())
    {
        Log::info('asdasdasd8a8asd8a8sdasd3333333333333333333333333333333333');
        $this->path = $view;
        $this->data = array_merge($mergeData, $this->parseData($data));

        return $this;
    }

    /**
     * Get the string contents of the view.
     *
     * @param  $callback  $callback
     * @return string
     */
    public function render(callable $callback = null)
    {
        Log::info('asdasdasd8a8asd8a8sdasd444444444444444444444444444444444');
        $contents = $this->renderContents();

        $response = isset($callback) ? $callback($this, $contents) : null;

        // Once we have the contents of the view, we will flush the sections if we are
        // done rendering all views so that there is nothing left hanging over when
        // anothoer view is rendered in the future by the application developers.
        View::flushSections();

        return $response ?: $contents;
    }

    /**
     * Get the contents of the view instance.
     *
     * @return string
     */
    protected function renderContents()
    {
        Log::info('asdasdasd8a8asd8a8sdasd55555555555555555555555555555555555');
        // We will keep track of the amount of views being rendered so we can flush
        // the section after the complete rendering operation is done. This will
        // clear out the sections for any separate views that may be rendered.
        View::incrementRender();

        $contents = $this->getContents();

        // Once we've finished rendering the view, we'll decrement the render count
        // so that each sections get flushed out next time a view is created and
        // no old sections are staying around in the memory of an environment.
        View::decrementRender();

        return $contents;
    }

    /**
     * Parse the given data into a raw array.
     *
     * @param  mixed  $data
     * @return array
     */
    protected function parseData($data)
    {
        Log::info('asdasdasd8a8asd8a8sdasd66666666666666666666666666');
        return $data instanceof Arrayable ? $data->toArray() : $data;
    }

    /**
     * Get the data bound to the view instance.
     *
     * @return array
     */
    protected function gatherData()
    {
        Log::info('asdasdasd8a8asd8a8sdasd777777777777777777777777777777');
        $data = array_merge(View::getShared(), $this->data);

        foreach ($data as $key => $value) {
            if ($value instanceof Renderable) {
                $data[$key] = $value->render();
            }
        }

        return $data;
    }

    /**
     * Add a view instance to the view data.
     *
     * @param  string  $key
     * @param  string  $view
     * @param  array   $data
     * @return \Illuminate\View\View
     */
    public function nest($key, $view, array $data = array())
    {
        Log::info('asdasdasd8a8asd8a8sdasd888888888888888888888888888888');
        return $this->with($key, View::make($view, $data));
    }

    /**
     * Determine if a piece of data is bound.
     *
     * @param  string  $key
     * @return bool
     */
    public function offsetExists($key)
    {
        Log::info('asdasdasd8a8asd8a8sdasd9999999999999999999999999999999');
        return array_key_exists($key, $this->data);
    }

    /**
     * Get a piece of bound data to the view.
     *
     * @param  string  $key
     * @return mixed
     */
    public function offsetGet($key)
    {
        Log::info('asdasdasd8a8asd8a8sdasd100000000000000000000100000000');
        return $this->data[$key];
    }

    /**
     * Set a piece of data on the view.
     *
     * @param  string  $key
     * @param  mixed   $value
     * @return void
     */
    public function offsetSet($key, $value)
    {
        Log::info('chixZXZX11111111111111');
        $this->with($key, $value);
    }

    /**
     * Unset a piece of data from the view.
     *
     * @param  string  $key
     * @return void
     */
    public function offsetUnset($key)
    {
        Log::info('chixZXZX1111111111111122222222222222222222222');
        unset($this->data[$key]);
    }
}
