<?php
/**
 * Service for CANDDi Company Lookup
 *
 * @author Tim Langley
 **/

namespace CanddiAi\Lookup;

use CanddiAi\Singleton\InterfaceSingleton;
use CanddiAi\Response\Company as ResponseCompany;
use CanddiAi\Traits\TraitSingleton;
use CanddiAi\Traits\GetArrayValue as NS_traitArrayValue;

class Company
    implements InterfaceSingleton
{
    use TraitSingleton;
    use NS_traitArrayValue;

    const c_URL_CompanyName = 'lookup/companyname/%s';
    const c_URL_Host    = 'lookup/hostname/%s';
    const c_URL_IP      = 'lookup/ip/%s';
    const c_URL_Name    = 'lookup/company/%s';

    private function cleanseForURL($str){
        return str_replace('/', '%2F', $str);
    }

    /**
     * Calls https://ip.candd.ai/lookup/companyname/[companyname]
     * end point and returns an array of data
     *
     * @param   string $strHostname
     * @param   optional string $strAccountURL
     * @param   optional string $guidContactId
     *
     * @return  Response\Company
     *
    **/
    public function lookupCompanyName(
        $strCompanyName,
        $strAccountURL = null,
        $guidContactId = null,
        $strCallbackUrl = null,
        $arrCallbackOptions = []
    )
    {
        $strURL             = sprintf(self::c_URL_CompanyName, $this->cleanseForURL($strCompanyName));
        $arrQuery           = [
            'accounturl'    => $strAccountURL,
            'contactid'     => $guidContactId,
            'cburl'         => $strCallbackUrl,
            'cboptions'     => str_replace('"', '\\"', json_encode($arrCallbackOptions,JSON_FORCE_OBJECT))
        ];
        try {
            $arrResponse    = $this->_callEndpoint(
                $strURL,
                $arrQuery
            );
        } catch(\Exception $e) {
            throw new \Exception(
                "Service:Company:CompanyName returned error for ($strCompanyName) ".
                " on Account ($strAccountURL), Contact ($guidContactId) ".
                $e->getMessage()
            );
        }

        return new Response\Company($arrResponse);
    }
    /**
     * Calls https://ip.candd.ai/lookup/host/[hostname]
     * end point and returns an array of data
     *
     * @param   string $strHostname
     * @param   optional string $strAccountURL
     * @param   optional string $guidContactId
     *
     * @return  Response\Company
     *
    **/
    public function lookupHost(
        $strHostName,
        $strAccountURL = null,
        $guidContactId = null,
        $strCallbackUrl = null,
        $arrCallbackOptions = []
    )
    {
        $strURL             = sprintf(self::c_URL_Host, $this->cleanseForURL($strHostName));
        $arrQuery           = [
            'accounturl'    => $strAccountURL,
            'contactid'     => $guidContactId,
            'cburl'         => $strCallbackUrl,
            'cboptions'     => str_replace('"', '\\"', json_encode($arrCallbackOptions,JSON_FORCE_OBJECT))
        ];

        try {
            $arrResponse    = $this->_callEndpoint(
                $strURL,
                $arrQuery
            );
        } catch(\Exception $e) {
            throw new \Exception(
                "Service:Company:Host returned error for ($strHostName) ".
                " on Account ($strAccountURL), Contact ($guidContactId) ".
                $e->getMessage()
            );
        }

        return new Response\Company($arrResponse);
    }
    /**
     * Calls https://api.candd.net/lookup/ip/[ipaddress]
     * end point and returns an array of data
     *
     * @param   string $mixedIPAddress (either dot notation or integer)
     * @param   optional string $strAccountURL
     * @param   optional string $guidContactId
     *
     * @return  Response\Company
     *
    **/
    public function lookupIP(
        $mixedIPAddress,
        $strAccountURL = null,
        $guidContactId = null,
        $strCallbackUrl = null,
        $arrCallbackOptions = []
    )
    {
        $strURL             = sprintf(self::c_URL_IP, $this->cleanseForURL($mixedIPAddress));
        $arrQuery           = [
            'accounturl'    => $strAccountURL,
            'contactid'     => $guidContactId,
            'cburl'         => $strCallbackUrl,
            'cboptions'     => str_replace('"', '\\"', json_encode($arrCallbackOptions,JSON_FORCE_OBJECT))
        ];

        try {
            $arrResponse    = $this->_callEndpoint(
                $strURL,
                $arrQuery
            );
        } catch(\Exception $e) {
            throw new \Exception(
                "Service:Company:IP returned error for ($mixedIPAddress) ".
                " on Account ($strAccountURL), Contact ($guidContactId) ".
                $e->getMessage()
            );
        }

        return new Response\Company($arrResponse);
    }

    public function lookupName(
        $strCompanyName,
        $strAccountURL = null,
        $guidContactId = null,
        $strCallbackUrl = null,
        $arrCallbackOptions = []
    )
    {
        $strURL             = sprintf(self::c_URL_Name, $this->cleanseForURL($strCompanyName));
        $arrQuery           = [
            'accounturl'    => $strAccountURL,
            'contactid'     => $guidContactId,
            'cburl'         => $strCallbackUrl,
            'cboptions'     => str_replace('"', '\\"', json_encode($arrCallbackOptions,JSON_FORCE_OBJECT))
        ];

        try {
            $arrResponse    = $this->_callEndpoint(
                $strURL,
                $arrQuery
            );
        } catch(\Exception $e) {
            throw new \Exception(
                "Service:Company:Name returned error for ($strCompanyName) ".
                " on Account ($strAccountURL), Contact ($guidContactId) ".
                $e->getMessage()
            );
        }

        return new Response\Company($arrResponse);
    }
}
