<?php

/**
 * CoverageChecker
 *
 * Copyright (c) 2013 Cesar Delgado <chebetos@gmail.com>.
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without 
 * modification, are permitted provided that the following conditions
 * are met:
 *
 * * Redistributions of source code must retain the above copyright
 * notice, this list of conditions and the following disclaimer.
 *
 * * Redistributions in binary form must reproduce the above copyright
 * notice, this list of conditions and the following disclaimer in
 * the documentation and/or other materials provided with the
 * distribution.
 *
 * * Neither the name of Sebastian Bergmann nor the names of his
 * contributors may be used to endorse or promote products derived
 * from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS
 * FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 * COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
 * BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
 * LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
 * ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @author Cesar Delgado <chebetos@gmail.com>
 * @copyright 2013 Cesar Delgado <chebetos@gmail.com>
 * @license http://www.opensource.org/licenses/BSD-3-Clause The BSD 3-Clause License
 * @link http://github.com/Chebetos/CoverageChecker
 * @since File available since Release 1.0.0
 */

namespace Chebetos\CoverageChecker;

/**
 * Command Runner for the Command Line Interface (CLI)
 * PHP SAPI Module.
 *
 * @author Cesar Delgado <chebetos@gmail.com> 
 * @copyright 2013 Cesar Delgado <chebetos@gmail.com>
 * @license http://www.opensource.org/licenses/BSD-3-Clause The BSD 3-Clause License
 * @link http://github.com/Chebetos/CoverageChecker
 * @since File available since Release 1.0.0
 */
class Command {

    /**
     * Exit code if success
     */
    const SUCCESS_EXIT = 0;

    /**
     * Exit code if not success
     */
    const FAILURE_EXIT = 1;

    /**
     * Exit code if there are any exception
     */
    const EXCEPTION_EXIT = 2;

    /**
     * @param boolean $exit
     */
    public static function main($exit = TRUE) {
        $command = new PHPUnit_TextUI_Command;
        return $command->run($_SERVER['argv'], $exit);
    }

    /**
     * @param array $argv
     * @param boolean $exit
     */
    public function run(array $argv, $exit = TRUE) {
        $inputFile = $argv[1];
        $percentage = min(100, max(0, (int) $argv[2]));

        if (!file_exists($inputFile)) {
            throw new InvalidArgumentException('Invalid input file provided');
        }

        if (!$percentage) {
            throw new InvalidArgumentException('An integer checked percentage must be given as second parameter');
        }
        
        $coverageChecker = new CoverageChecker();
        
        $coverage = $coverageChecker->getCodeCoverage($inputFile);

        $result = Command::SUCCESS_EXIT;
        if ($coverage < $percentage) {
            echo 'Code coverage is ' . $coverage . '%, which is below the accepted ' . $percentage . '%' . PHP_EOL;
            $result = Command::FAILURE_EXIT;
        } else {
            echo 'Code coverage is ' . $coverage . '% - OK!' . PHP_EOL;
        }

        if ($exit) {
            exit($result);
        } else {
            return $result;
        }
    }

}
