<?php

namespace Bariseser;

/**
 * Class HashManager
 * PHP Hash Manager provides secure BCRYPT, ARGON2I or ARGON2ID hashing for storing user passwords or etc.
 * @license MIT
 * https://github.com/bariseser/php-password-hash
 *
 * @package Bariseser
 * @author baris eser<bariseser@gmail.com>
 */
class HashManager
{

    /**
     * Class static
     *
     * @var self
     */
    private static $instance = null;

    /**
     * selected algorithm
     *
     * @var int
     */
    private $algorithm;

    /**
     * PASSWORD_ARGON2I OR PASSWORD_ARGON2ID constant
     *
     * @constant int
     */
    const ARGON2I = 2;

    const ARGON2ID = 3;

    /**
     * PASSWORD_BCRYPT constant
     *
     * @constant int
     */
    const BCRYPT = 1;

    /**
     * PASSWORD_ARGON2I or PASSWORD_ARGON2ID default options
     *
     * @var array
     */
    private $defaultArgon2Options = [
        'memory_cost' => 1024,
        'time_cost' => 2,
        'threads' => 2,
    ];

    /**
     * PASSWORD_BCRYPT default options
     *
     * @var array
     */
    private $defaultBcryptOptions = [
        'cost' => 10,
    ];

    /**
     * selected options
     *
     * @var array
     */
    private $options = [];

    /**
     * @return HashManager
     */
    public static function getInstance(): self
    {

        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     *
     * @param string $algorithm
     * @param array $options
     * @return $this
     */
    public function initialize(int $algorithm = 0, $options = array()): self
    {
        if (PHP_VERSION >= 7.3) {
            $this->algorithm = !empty($algorithm) ? $algorithm : self::ARGON2ID;
            $this->options = !empty($options) ? $options : $this->defaultArgon2Options;
        } else if (PHP_VERSION >= 7.2 && PHP_VERSION < 7.3) {
            $this->algorithm = (!empty($algorithm) && $algorithm != self::ARGON2ID) ? $algorithm : self::ARGON2I;
            $this->options = !empty($options) ? $options : $this->defaultArgon2Options;
        } else {
            $this->algorithm = self::BCRYPT;
            $this->options = !empty($options) ? $options : $this->defaultBcryptOptions;
        }

        return $this;
    }

    /**
     * creates a new password hash using a strong one-way hashing algorithm
     * @param string $password
     * @return string
     */
    public function hash(string $password): string
    {
        return password_hash($password, $this->algorithm, $this->options);
    }

    /**
     * Verifies that a password matches a hash
     * @param string $password
     * @param string $hash
     * @return bool
     */
    public function validate(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }

    /**
     * Returns information about the given hash
     * @param string $hash
     * @return array
     */
    public function getInfo(string $hash): array
    {
        return password_get_info($hash);
    }

    /**
     * @return int
     */
    public function getAlgorithm(): int
    {
        return $this->algorithm;
    }

    /**
     * @param int $algorithm
     */
    public function setAlgorithm(int $algorithm)
    {

        if (PHP_VERSION >= 7.3) {
            $this->algorithm = !empty($algorithm) ? $algorithm : self::ARGON2ID;
        } else if (PHP_VERSION >= 7.2 && PHP_VERSION < 7.3) {
            $this->algorithm = (!empty($algorithm) && $algorithm != self::ARGON2ID) ? $algorithm : self::ARGON2I;
        } else {
            $this->algorithm = self::BCRYPT;
        }
    }

}
