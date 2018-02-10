<?php

/* index.view.php */
class __TwigTemplate_266932018ab00640360d2be63d2f117b7ef6c4fbcf92316fe9221f3f8603ff4c extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "asd";
    }

    public function getTemplateName()
    {
        return "index.view.php";
    }

    public function getDebugInfo()
    {
        return array (  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("asd", "index.view.php", "/home/aashari/Workspaces/aashari/simple-php-mvc/views/index.view.php");
    }
}
