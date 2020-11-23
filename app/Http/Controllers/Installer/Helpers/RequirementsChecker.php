<?php
/*   __________________________________________________
    |  Obfuscated by YAK Pro - Php Obfuscator  2.0.1   |
    |              on 2020-07-14 08:37:20              |
    |    GitHub: https://github.com/pk-fr/yakpro-po    |
    |__________________________________________________|
/*
* Copyright (C) Amar Systems, Inc - All Rights Reserved
* Unauthorized copying of this file, via any medium is strictly prohibited
* Proprietary and confidential
* Written by EH Khan <amarmarketplace@gmail.com>, June 2020
*/
 namespace App\Http\Controllers\Installer\Helpers; class RequirementsChecker { private $_minPhpVersion = "\x37\x2e\x32\56\60"; public function check(array $requirements) { $results = []; foreach ($requirements as $type => $requirement) { switch ($type) { case "\x70\150\160": foreach ($requirements[$type] as $requirement) { $results["\x72\145\161\165\151\162\145\155\x65\156\x74\x73"][$type][$requirement] = true; if (extension_loaded($requirement)) { goto C9hfN; } $results["\162\145\x71\x75\x69\162\145\155\x65\156\164\x73"][$type][$requirement] = false; $results["\x65\162\162\157\162\x73"] = true; C9hfN: pzFuM: } LfjCb: goto rQgGh; case "\141\x70\x61\143\150\145": foreach ($requirements[$type] as $requirement) { if (!function_exists("\x61\160\x61\143\150\x65\137\x67\145\x74\137\x6d\x6f\x64\165\154\145\x73")) { goto CpG03; } $results["\x72\145\161\x75\151\x72\145\155\145\156\x74\163"][$type][$requirement] = true; if (in_array($requirement, apache_get_modules())) { goto k1y3D; } $results["\162\145\161\165\x69\162\145\155\145\x6e\x74\163"][$type][$requirement] = false; $results["\145\162\x72\x6f\x72\x73"] = true; k1y3D: CpG03: lSLu8: } SiYTd: goto rQgGh; } IRdyf: rQgGh: QBw3L: } y312D: return $results; } public function checkPHPversion(string $minPhpVersion = null, string $maxPhpVersion = null) { $currentPhpVersion = $this->getPhpVersionInfo(); $supported = false; if (!($minPhpVersion == null)) { goto Obxan; } $minPhpVersion = $this->getMinPhpVersion(); Obxan: if (!($maxPhpVersion == null)) { goto Uxk4e; } $maxPhpVersion = $currentPhpVersion["\x76\x65\162\163\151\x6f\x6e"]; Uxk4e: if (!(version_compare($currentPhpVersion["\x76\x65\162\163\x69\157\156"], $minPhpVersion, "\76\x3d") && version_compare($currentPhpVersion["\x76\145\162\163\151\x6f\156"], $maxPhpVersion, "\x3c\x3d"))) { goto Sz21F; } $supported = true; Sz21F: $phpStatus = ["\x66\x75\x6c\x6c" => $currentPhpVersion["\146\165\154\x6c"], "\143\x75\162\x72\145\156\x74" => $currentPhpVersion["\166\145\x72\x73\151\x6f\156"], "\155\151\x6e\151\155\x75\x6d" => $minPhpVersion, "\x6d\141\170\151\155\165\x6d" => $maxPhpVersion, "\x73\x75\x70\x70\x6f\x72\164\x65\x64" => $supported]; return $phpStatus; } private static function getPhpVersionInfo() { $currentVersionFull = PHP_VERSION; preg_match("\43\136\134\x64\x2b\x28\134\x2e\134\144\x2b\x29\52\x23", $currentVersionFull, $filtered); $currentVersion = $filtered[0]; return ["\146\165\154\154" => $currentVersionFull, "\x76\145\x72\163\x69\157\x6e" => $currentVersion]; } protected function getMinPhpVersion() { return $this->_minPhpVersion; } }