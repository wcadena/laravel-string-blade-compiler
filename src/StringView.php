<?php
namespace Wcadena\StringBladeCompiler;


class StringView extends StringViewMaster
{

    /** @var \Illuminate\Config\Repository */
    protected static $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    /**
     * Get a evaluated view contents for the given view.
     *
     * @param  string  $view
     * @param  array   $data
     * @param  array   $mergeData
     * @return \Illuminate\View\View
     */
    public static function make($view, $data = array(), $mergeData = array())
    {
        $stringViewMaster = new StringViewMaster(self::$config);

        return $stringViewMaster->makeMaster($view, $data, $mergeData);
    }
}
