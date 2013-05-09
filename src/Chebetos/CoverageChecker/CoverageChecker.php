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
 * @author César Augusto Delgado Rodríguez <chebetos@gmail.com>
 * @copyright 2013 César Augusto Delgado Rodríguez <chebetos@gmail.com>
 * @license http://www.opensource.org/licenses/BSD-3-Clause The BSD 3-Clause License
 * @link http://github.com/Chebetos/CoverageChecker
 * @since File available since Release 1.0.0
 */

namespace Chebetos\CoverageChecker;

/**
 * Class with the method to get the code covarage percentage from an clover 
 * style xml file.
 *
 * @author Cesar Delgado <chebetos@gmail.com> 
 * @copyright 2013 Cesar Delgado <chebetos@gmail.com>
 * @license http://www.opensource.org/licenses/BSD-3-Clause The BSD 3-Clause License
 * @link http://github.com/Chebetos/CoverageChecker
 * @since File available since Release 1.0.0
 */
class CoverageChecker
{

    /**
     * Calculate codecoverage based on $inputFile, that must be an clover style 
     * xml.
     * 
     * @param string $inputFile
     * 
     * @return int Coverage percentage
     */
    public function getCodeCoverage($inputFile) {
        $xml = new SimpleXMLElement(file_get_contents($inputFile));
        /* @var $metrics SimpleXMLElement[] */
        $metrics = $xml->xpath('//metrics');

        $totalElements = 0;
        $checkedElements = 0;

        foreach ($metrics as $metric) {
            $totalElements += (int) $metric['elements'];
            $checkedElements += (int) $metric['coveredelements'];
        }

        $coverage = round(($checkedElements / $totalElements) * 100);
        return $coverage;
    }

}

