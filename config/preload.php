<?php

/**
 * Preload kernel
 * php version 7.6
 *
 * @category Api
 * @package  Symphony_Api
 * @author   User <user@log.pt>
 * @license  MIT License (c) copyright 2011-2013 original author or authors
 * @link     https://github.com/falcon758/symphony_api
 */

if (file_exists(dirname(__DIR__).'/var/cache/prod/App_KernelProdContainer.preload.php')) {
    require dirname(__DIR__).'/var/cache/prod/App_KernelProdContainer.preload.php';
}
