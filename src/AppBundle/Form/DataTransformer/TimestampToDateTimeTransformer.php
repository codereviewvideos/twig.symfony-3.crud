<?php

namespace AppBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;

class TimestampToDateTimeTransformer implements DataTransformerInterface
{
    /**
     * @param \DateTime $datetime
     */
    public function transform($datetime)
    {
        if ($datetime === null) {
            return (new \DateTime('now'))->getTimestamp();
        }

        return $datetime->getTimestamp();
    }

    public function reverseTransform($timestamp)
    {
        return (new \DateTime())->setTimestamp($timestamp);
    }
}
