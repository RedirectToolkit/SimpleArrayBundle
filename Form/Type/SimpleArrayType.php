<?php

namespace Rdir\SimpleArrayBundle\Form\Type;

use Rdir\SimpleArrayBundle\Form\DataTransformer\SimpleArrayTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class SimpleArrayType extends AbstractType
{
    /**
     * Builds the form.
     *
     * This method is called for each type in the hierarchy starting from the
     * top most type. Type extensions can further modify the form.
     *
     * @param FormBuilderInterface $builder The form builder.
     * @param array                $options The options.
     *
     * @see    FormTypeExtensionInterface::buildForm()
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addViewTransformer(new SimpleArrayTransformer());
    }

    /**
     * Returns the name of the parent type.
     *
     * You can also return a type instance from this method, although doing so
     * is discouraged because it leads to a performance penalty. The support
     * for returning type instances may be dropped from future releases.
     *
     * @return string
     */
    public function getParent()
    {
        return 'text';
    }

    /**
     * Returns the name of this type.
     *
     * @return string
     */
    public function getName()
    {
        return 'simple_array';
    }
}
