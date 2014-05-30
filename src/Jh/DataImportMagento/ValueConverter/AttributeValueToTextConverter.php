<?php
namespace Jh\DataImportMagento\ValueConverter;

use Ddeboer\DataImport\ValueConverter\ValueConverterInterface;

/**
 * Uses Mage_Eav_Model_Config to get the attribute option text using the specified entity.
 *
 * Class AttributeValueToTextConverter
 * @author Adam Paterson <adam@wearejh.com>
 */
class AttributeValueToTextConverter implements ValueConverterInterface
{
    /**
     * @var \Mage_Eav_Model_Config
     */
    protected $eavModel;

    /**
     * @var string Eav entity type ID.
     */
    protected $entityTypeId;

    /**
     * @var string
     */
    protected $attributeCode;

    /**
     * @param \Mage_Eav_Model_Config $eavModel
     * @param $entityTypeId
     * @param $attributeCode
     */
    public function __construct(
        \Mage_Eav_Model_Config $eavModel,
        $entityTypeId,
        $attributeCode
    ) {
        $this->eavModel = $eavModel;
        $this->entityTypeId = $entityTypeId;
        $this->attributeCode = $attributeCode;
    }

    /**
     * @param mixed $input
     * @return bool|string
     */
    public function convert($input)
    {
        $value = $this->eavModel
            ->getAttribute($this->entityTypeId, $this->attributeCode)
            ->getSource()
            ->getOptionText($input);
        return $value;
    }
}
