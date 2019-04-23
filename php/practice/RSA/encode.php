<?php
/**
 * RSA 的加密与解密
 *
 *
 *
 *
 *
 */

$publicKey = <<<EOF
-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQC0nUsO81MHGT86oew1KBXBteuz
eJa5dSgxejsF5KnedMYHbnt1xJY3Hx4xJaABo68a5JV5I8Qy5NK7gCwYNMOsGKKn
eWOnwHoFb+MFOscJgEIO6UT8lGY9l7eikoUIurQPuDgRMcf84Da76e4d6KmFNHON
HL6Z5St9RyS/p1B+XQIDAQAB
-----END PUBLIC KEY-----
EOF;

$secretKey = <<<EOF
-----BEGIN RSA PRIVATE KEY-----
MIICXQIBAAKBgQC0nUsO81MHGT86oew1KBXBteuzeJa5dSgxejsF5KnedMYHbnt1
xJY3Hx4xJaABo68a5JV5I8Qy5NK7gCwYNMOsGKKneWOnwHoFb+MFOscJgEIO6UT8
lGY9l7eikoUIurQPuDgRMcf84Da76e4d6KmFNHONHL6Z5St9RyS/p1B+XQIDAQAB
AoGAXKG/eS96ic19DEk3qBui7PKsrCNQylU4BAg4dVFNffZOCkmzsDbfA+5FwdcW
NUEJ8bUCpFqfqaqKGfgmpVOKdsAfAdf+4WEs0fiHQqIFgipS02CCWq7+MwrxIWqq
vsj7zP0N5DzvBgMLPXyCOOmaCCaKngCprFGjK2xeB7FfTgECQQDmsQTMFYNo91Yg
r9QLz3/rHBTBrl9Vn2mHVTE1J1vAgjC+Vl0Xp+6rjg20YU4xIJB9dFOh4l+CHcPL
1ZxuJlhhAkEAyG3bp5pLdXi6qaRgjBkrcjJ0ellyL/6IryNQ4+ZFZbe4diCyKUWo
X/iWQ+6QUekm6tPt3tmR8xEotsv75aq3fQJAUvTPI9CMq99dkm2IFCMu/c3gTPG2
iKTFnwvsoQ+hN+3ZN2j5GvuhoQF5PidLpfDu5J5DQNCVxcWMVi1fjmCtoQJBAJiN
VXS6MdkVrS3V2U6JEdJ3qMQ/NHRnTe3P+Y+dAxEqxxHSTQiw5jk14lmOSPaveVmf
ORw3iajyVITdubrTN5kCQQDGsOtFPVP7109aj/uCgPT90qwsDbLALE1knVyF0OxH
tp6B4HbRlr9DIYp7zatSOC1BCzIbD/RpJjnG4XV45bs6
-----END RSA PRIVATE KEY-----
EOF;

$data = [
    'List' => [
        'AAA' => 'aaaa'
    ]
];
$data = json_encode($data);

openssl_public_encrypt($data, $publicEncode, $publicKey);
$publicEncode = base64_encode($publicEncode);
var_dump($publicEncode);

$publicEncode = base64_decode($publicEncode);
openssl_private_decrypt($publicEncode, $privateDecode, $secretKey);
var_dump($privateDecode);



