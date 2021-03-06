<?php
/**
 * PtsV2PaymentsPost201ResponseProcessorInformationRouting
 *
 * PHP version 5
 *
 * @category Class
 * @package  Incevio\Cybersource\CybersourceSDK
 * @author   Swaagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */

/**
 * Incevio\Cybersource\CybersourceSDK Merged Spec
 *
 * All Incevio\Cybersource\CybersourceSDK API specs merged together. These are available at https://developer.cybersource.com/api/reference/api-reference.html
 *
 * OpenAPI spec version: 0.0.1
 *
 * Generated by: https://github.com/swagger-api/swagger-codegen.git
 *
 */

/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace Incevio\Cybersource\CybersourceSDK\Model;

use \ArrayAccess;

/**
 * PtsV2PaymentsPost201ResponseProcessorInformationRouting Class Doc Comment
 *
 * @category    Class
 * @package     Incevio\Cybersource\CybersourceSDK
 * @author      Swagger Codegen team
 * @link        https://github.com/swagger-api/swagger-codegen
 */
class PtsV2PaymentsPost201ResponseProcessorInformationRouting implements ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      * @var string
      */
    protected static $swaggerModelName = 'ptsV2PaymentsPost201Response_processorInformation_routing';

    /**
      * Array of property to type mappings. Used for (de)serialization
      * @var string[]
      */
    protected static $swaggerTypes = [
        'network' => 'string',
        'networkName' => 'string',
        'customerSignatureRequired' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      * @var string[]
      */
    protected static $swaggerFormats = [
        'network' => null,
        'networkName' => null,
        'customerSignatureRequired' => null
    ];

    public static function swaggerTypes()
    {
        return self::$swaggerTypes;
    }

    public static function swaggerFormats()
    {
        return self::$swaggerFormats;
    }

    /**
     * Array of attributes where the key is the local name, and the value is the original name
     * @var string[]
     */
    protected static $attributeMap = [
        'network' => 'network',
        'networkName' => 'networkName',
        'customerSignatureRequired' => 'customerSignatureRequired'
    ];


    /**
     * Array of attributes to setter functions (for deserialization of responses)
     * @var string[]
     */
    protected static $setters = [
        'network' => 'setNetwork',
        'networkName' => 'setNetworkName',
        'customerSignatureRequired' => 'setCustomerSignatureRequired'
    ];


    /**
     * Array of attributes to getter functions (for serialization of requests)
     * @var string[]
     */
    protected static $getters = [
        'network' => 'getNetwork',
        'networkName' => 'getNetworkName',
        'customerSignatureRequired' => 'getCustomerSignatureRequired'
    ];

    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    public static function setters()
    {
        return self::$setters;
    }

    public static function getters()
    {
        return self::$getters;
    }





    /**
     * Associative array for storing property values
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     * @param mixed[] $data Associated array of property values initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['network'] = isset($data['network']) ? $data['network'] : null;
        $this->container['networkName'] = isset($data['networkName']) ? $data['networkName'] : null;
        $this->container['customerSignatureRequired'] = isset($data['customerSignatureRequired']) ? $data['customerSignatureRequired'] : null;
    }

    /**
     * show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalid_properties = [];

        if (!is_null($this->container['network']) && (strlen($this->container['network']) > 1)) {
            $invalid_properties[] = "invalid value for 'network', the character length must be smaller than or equal to 1.";
        }

        if (!is_null($this->container['networkName']) && (strlen($this->container['networkName']) > 10)) {
            $invalid_properties[] = "invalid value for 'networkName', the character length must be smaller than or equal to 10.";
        }

        if (!is_null($this->container['customerSignatureRequired']) && (strlen($this->container['customerSignatureRequired']) > 1)) {
            $invalid_properties[] = "invalid value for 'customerSignatureRequired', the character length must be smaller than or equal to 1.";
        }

        return $invalid_properties;
    }

    /**
     * validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {

        if (strlen($this->container['network']) > 1) {
            return false;
        }
        if (strlen($this->container['networkName']) > 10) {
            return false;
        }
        if (strlen($this->container['customerSignatureRequired']) > 1) {
            return false;
        }
        return true;
    }


    /**
     * Gets network
     * @return string
     */
    public function getNetwork()
    {
        return $this->container['network'];
    }

    /**
     * Sets network
     * @param string $network Indicates whether the transaction was routed on a credit network, a debit network, or the STAR signature debit network.  Possible values: - `C`: Credit network - `D`: Debit network (without signature) - `S`: STAR signature debit network  This field is supported only on FDC Nashville Global.  For details, see the `routing_network_type` field description in [Card-Present Processing Using the SCMP API.](https://apps.cybersource.com/library/documentation/dev_guides/Retail_SCMP_API/html/)
     * @return $this
     */
    public function setNetwork($network)
    {
        if (!is_null($network) && (strlen($network) > 1)) {
            throw new \InvalidArgumentException('invalid length for $network when calling PtsV2PaymentsPost201ResponseProcessorInformationRouting., must be smaller than or equal to 1.');
        }

        $this->container['network'] = $network;

        return $this;
    }

    /**
     * Gets networkName
     * @return string
     */
    public function getNetworkName()
    {
        return $this->container['networkName'];
    }

    /**
     * Sets networkName
     * @param string $networkName Name of the network on which the transaction was routed.  This field is supported only on FDC Nashville Global.  For details, see the `routing_network_label` field description in [Card-Present Processing Using the SCMP API.](https://apps.cybersource.com/library/documentation/dev_guides/Retail_SCMP_API/html/)
     * @return $this
     */
    public function setNetworkName($networkName)
    {
        if (!is_null($networkName) && (strlen($networkName) > 10)) {
            throw new \InvalidArgumentException('invalid length for $networkName when calling PtsV2PaymentsPost201ResponseProcessorInformationRouting., must be smaller than or equal to 10.');
        }

        $this->container['networkName'] = $networkName;

        return $this;
    }

    /**
     * Gets customerSignatureRequired
     * @return string
     */
    public function getCustomerSignatureRequired()
    {
        return $this->container['customerSignatureRequired'];
    }

    /**
     * Sets customerSignatureRequired
     * @param string $customerSignatureRequired Indicates whether you need to obtain the cardholder's signature.  Possible values: - `Y`: You need to obtain the cardholder's signature. - `N`: You do not need to obtain the cardholder's signature.  This field is supported only on FDC Nashville Global.  For details, see the `routing_signature_cvm_required` field description in [Card-Present Processing Using the SCMP API.](https://apps.cybersource.com/library/documentation/dev_guides/Retail_SCMP_API/html/)
     * @return $this
     */
    public function setCustomerSignatureRequired($customerSignatureRequired)
    {
        if (!is_null($customerSignatureRequired) && (strlen($customerSignatureRequired) > 1)) {
            throw new \InvalidArgumentException('invalid length for $customerSignatureRequired when calling PtsV2PaymentsPost201ResponseProcessorInformationRouting., must be smaller than or equal to 1.');
        }

        $this->container['customerSignatureRequired'] = $customerSignatureRequired;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     * @param  integer $offset Offset
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     * @param  integer $offset Offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }

    /**
     * Sets value based on offset.
     * @param  integer $offset Offset
     * @param  mixed   $value  Value to be set
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     * @param  integer $offset Offset
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /**
     * Gets the string presentation of the object
     * @return string
     */
    public function __toString()
    {
        if (defined('JSON_PRETTY_PRINT')) { // use JSON pretty print
            return json_encode(\Incevio\Cybersource\CybersourceSDK\ObjectSerializer::sanitizeForSerialization($this), JSON_PRETTY_PRINT);
        }

        return json_encode(\Incevio\Cybersource\CybersourceSDK\ObjectSerializer::sanitizeForSerialization($this));
    }
}


