<?php

namespace Rdir\SimpleArrayBundle\Form;

use Symfony\Bridge\Doctrine\Form\DoctrineOrmTypeGuesser as BaseDoctrineOrmTypeGuesser;
use Symfony\Component\Form\Guess\Guess;
use Symfony\Component\Form\Guess\TypeGuess;

class DoctrineOrmTypeGuesser extends BaseDoctrineOrmTypeGuesser
{
    /**
     * Returns a field guess for a property name of a class.
     *
     * @param string $class    The fully qualified class name.
     * @param string $property The name of the property to guess for.
     *
     * @return Guess\TypeGuess|null A guess for the field's type and options.
     */
    public function guessType($class, $property)
    {
        if (!$ret = $this->getMetadata($class)) {
            return new TypeGuess('text', array(), Guess::LOW_CONFIDENCE);
        }

        list($metadata, $name) = $ret;

        if ('simple_array' == $metadata->getTypeOfField($property)) {
            return new TypeGuess('simple_array', array(), Guess::MEDIUM_CONFIDENCE);
        }

        return parent::guessType($class, $property);
    }
}
