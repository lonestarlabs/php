<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: Invocation.proto

namespace Proto;

use Google\Protobuf\Internal\GPBUtil;

/**
 * Protobuf type <code>proto.Invocation.SQLInvocation.Query</code>
 */
class Invocation_SQLInvocation_Query extends \Google\Protobuf\Internal\Message
{
    /**
     * <code>string query = 1;</code>
     */
    private $query = '';
    /**
     * <code>map&lt;string, string&gt; parameter = 2;</code>
     */
    private $parameter;

    public function __construct()
    {
        \GPBMetadata\Invocation::initOnce();
        parent::__construct();
    }

    /**
     * <code>string query = 1;</code>
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * <code>string query = 1;</code>
     */
    public function setQuery($var)
    {
        GPBUtil::checkString($var, True);
        $this->query = $var;
    }

    /**
     * <code>map&lt;string, string&gt; parameter = 2;</code>
     */
    public function getParameter()
    {
        return $this->parameter;
    }

    /**
     * <code>map&lt;string, string&gt; parameter = 2;</code>
     */
    public function setParameter(&$var)
    {
        $this->parameter = $var;
    }

}
