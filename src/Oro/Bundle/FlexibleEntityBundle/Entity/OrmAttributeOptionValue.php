<?php
namespace Oro\Bundle\FlexibleEntityBundle\Entity;

use Oro\Bundle\FlexibleEntityBundle\Entity\Mapping\AbstractEntityAttributeOptionValue;
use Doctrine\ORM\Mapping as ORM;

/**
 * Attribute option values
 *
 * @author    Nicolas Dupont <nicolas@akeneo.com>
 * @copyright 2012 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/MIT MIT
 *
 * @ORM\Table(name="oroflexibleentity_attribute_option_value")
 * @ORM\Entity
 */
class OrmAttributeOptionValue extends AbstractEntityAttributeOptionValue
{

    /**
     * Overrided to change target option name
     *
     * @var OrmAttributeOption $option
     *
     * @ORM\ManyToOne(targetEntity="OrmAttributeOption", inversedBy="optionValues")
     * @ORM\JoinColumn(name="option_id", nullable=false, onDelete="CASCADE", referencedColumnName="id")
     */
    protected $option;

}
