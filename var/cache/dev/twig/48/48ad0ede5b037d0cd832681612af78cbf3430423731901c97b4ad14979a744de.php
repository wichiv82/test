<?php

/* security/login.html.twig */
class __TwigTemplate_91b16204db9a6dee7be83d30b20a11c6798dff38023086b4f13c2eb6ac837f59 extends Twig_Template
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
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "security/login.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "security/login.html.twig"));

        // line 1
        echo "<!DOCTYPE html>
<html>
    <head>
        <meta charset=\"UTF-8\" />
        <title>Formulaire de login</title>
    </head>
<body>

\t";
        // line 10
        echo "\t";
        if (($context["error"] ?? $this->getContext($context, "error"))) {
            // line 11
            echo "\t<div>";
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans($this->getAttribute(($context["error"] ?? $this->getContext($context, "error")), "messageKey", array()), $this->getAttribute(($context["error"] ?? $this->getContext($context, "error")), "messageData", array()), "security"), "html", null, true);
            echo "</div>
\t";
        }
        // line 13
        echo "\t<form action=\"";
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("login");
        echo "\" method=\"post\">
\t\t<label for=\"username\">Username:</label>
\t\t<input type=\"text\" id=\"username\" name=\"_username\" value=\"";
        // line 15
        echo twig_escape_filter($this->env, ($context["last_username"] ?? $this->getContext($context, "last_username")), "html", null, true);
        echo "\" />
\t\t<label for=\"password\">Password:</label>
\t\t<input type=\"password\" id=\"password\" name=\"_password\" />
\t\t";
        // line 20
        echo "\t\t<button type=\"submit\">login</button>
\t</form>
\t
\t</body>
\t
</html>
";
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    public function getTemplateName()
    {
        return "security/login.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  56 => 20,  50 => 15,  44 => 13,  38 => 11,  35 => 10,  25 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<!DOCTYPE html>
<html>
    <head>
        <meta charset=\"UTF-8\" />
        <title>Formulaire de login</title>
    </head>
<body>

\t{# app/Resources/views/security/login.html.twig #}
\t{% if error %}
\t<div>{{ error.messageKey|trans(error.messageData,'security') }}</div>
\t{% endif %}
\t<form action=\"{{ path('login') }}\" method=\"post\">
\t\t<label for=\"username\">Username:</label>
\t\t<input type=\"text\" id=\"username\" name=\"_username\" value=\"{{last_username }}\" />
\t\t<label for=\"password\">Password:</label>
\t\t<input type=\"password\" id=\"password\" name=\"_password\" />
\t\t{# pour contrôler l’url où l’utilisateur est redirigéen cas de succès :
\t\t<input type=\"hidden\" name=\"home\" value=\"/account\" /> #}
\t\t<button type=\"submit\">login</button>
\t</form>
\t
\t</body>
\t
</html>
", "security/login.html.twig", "/home/chiv/Documents/PWEB/TP2/mon_projet/app/Resources/views/security/login.html.twig");
    }
}
