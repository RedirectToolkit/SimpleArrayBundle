<?php

namespace Rdir\SimpleArrayBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;

class SimpleArrayTransformer implements DataTransformerInterface
{
    /**
     * Transforms a value from the original representation to a transformed representation.
     *
     * This method is called on two occasions inside a form field:
     *
     * 1. When the form field is initialized with the data attached from the datasource (object or array).
     * 2. When data from a request is submitted using {@link Form::submit()} to transform the new input data
     *    back into the renderable format. For example if you have a date field and submit '2009-10-10'
     *    you might accept this value because its easily parsed, but the transformer still writes back
     *    "2009/10/10" onto the form field (for further displaying or other purposes).
     *
     * This method must be able to deal with empty values. Usually this will
     * be NULL, but depending on your implementation other empty values are
     * possible as well (such as empty strings). The reasoning behind this is
     * that value transformers must be chainable. If the transform() method
     * of the first value transformer outputs NULL, the second value transformer
     * must be able to process that value.
     *
     * By convention, transform() should return an empty string if NULL is
     * passed.
     *
     * @param mixed $value The value in the original representation.
     *
     * @throws TransformationFailedException When the transformation fails.
     *
     * @return mixed The value in the transformed representation.
     */
    public function transform($value)
    {
        if (!$value) {
            // default value
            $value = array();
        }

        // concatenate the values to one string
        return trim(implode(', ', $value));
    }

    /**
     * Transforms a value from the transformed representation to its original representation.
     *
     * This method is called when {@link Form::submit()} is called to transform the requests tainted data
     * into an acceptable format for your data processing/model layer.
     *
     * This method must be able to deal with empty values. Usually this will
     * be an empty string, but depending on your implementation other empty
     * values are possible as well (such as empty strings). The reasoning behind
     * this is that value transformers must be chainable. If the
     * reverseTransform() method of the first value transformer outputs an
     * empty string, the second value transformer must be able to process that
     * value.
     *
     * By convention, reverseTransform() should return NULL if an empty string
     * is passed.
     *
     * @param mixed $value The value in the transformed representation.
     *
     * @throws TransformationFailedException When the transformation fails.
     *
     * @return mixed The value in the original representation.
     */
    public function reverseTransform($value)
    {
        if (!$value) {
            // default
            $value = '';
        }

        // 1. Split the string with commas
        // 2. Remove whitespaces around the values
        // 3. Remove empty elements (like in "tag1,tag2, ,,tag3,tag4")
        return array_filter(array_map('trim', explode(',', $value)));
    }
}
