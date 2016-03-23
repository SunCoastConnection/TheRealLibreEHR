<?php

require_once("../../globals.php");
include_once("$srcdir/sql.inc");

if (isset($_REQUEST['PQRS_0001'])) { $PQRS_0001 = 1; } else { $PQRS_0001 = 0; }
if (isset($_REQUEST['PQRS_0005'])) { $PQRS_0005 = 1; } else { $PQRS_0005 = 0; } 
if (isset($_REQUEST['PQRS_0006'])) { $PQRS_0006 = 1; } else { $PQRS_0006 = 0; }
if (isset($_REQUEST['PQRS_0007'])) { $PQRS_0007 = 1; } else { $PQRS_0007 = 0; }
if (isset($_REQUEST['PQRS_0008'])) { $PQRS_0008 = 1; } else { $PQRS_0008 = 0; }
if (isset($_REQUEST['PQRS_0012'])) { $PQRS_0012 = 1; } else { $PQRS_0012 = 0; }
if (isset($_REQUEST['PQRS_0014'])) { $PQRS_0014 = 1; } else { $PQRS_0014 = 0; }
if (isset($_REQUEST['PQRS_0019'])) { $PQRS_0019 = 1; } else { $PQRS_0019 = 0; }
if (isset($_REQUEST['PQRS_0021'])) { $PQRS_0021 = 1; } else { $PQRS_0021 = 0; }
if (isset($_REQUEST['PQRS_0022'])) { $PQRS_0022 = 1; } else { $PQRS_0022 = 0; } 
if (isset($_REQUEST['PQRS_0023'])) { $PQRS_0023 = 1; } else { $PQRS_0023 = 0; }
if (isset($_REQUEST['PQRS_0024'])) { $PQRS_0024 = 1; } else { $PQRS_0024 = 0; }
if (isset($_REQUEST['PQRS_0032'])) { $PQRS_0032 = 1; } else { $PQRS_0032 = 0; }
if (isset($_REQUEST['PQRS_0033'])) { $PQRS_0033 = 1; } else { $PQRS_0033 = 0; }
if (isset($_REQUEST['PQRS_0039'])) { $PQRS_0039 = 1; } else { $PQRS_0039 = 0; }
if (isset($_REQUEST['PQRS_0040'])) { $PQRS_0040 = 1; } else { $PQRS_0040 = 0; }
if (isset($_REQUEST['PQRS_0041'])) { $PQRS_0041 = 1; } else { $PQRS_0041 = 0; }
if (isset($_REQUEST['PQRS_0043'])) { $PQRS_0043 = 1; } else { $PQRS_0043 = 0; } 
if (isset($_REQUEST['PQRS_0044'])) { $PQRS_0044 = 1; } else { $PQRS_0044 = 0; }
if (isset($_REQUEST['PQRS_0046'])) { $PQRS_0046 = 1; } else { $PQRS_0046 = 0; }
if (isset($_REQUEST['PQRS_0047'])) { $PQRS_0047 = 1; } else { $PQRS_0047 = 0; }
if (isset($_REQUEST['PQRS_0048'])) { $PQRS_0048 = 1; } else { $PQRS_0048 = 0; }
if (isset($_REQUEST['PQRS_0050'])) { $PQRS_0050 = 1; } else { $PQRS_0050 = 0; }
if (isset($_REQUEST['PQRS_0051'])) { $PQRS_0051 = 1; } else { $PQRS_0051 = 0; }
if (isset($_REQUEST['PQRS_0052'])) { $PQRS_0052 = 1; } else { $PQRS_0052 = 0; }
if (isset($_REQUEST['PQRS_0053'])) { $PQRS_0053 = 1; } else { $PQRS_0053 = 0; } 
if (isset($_REQUEST['PQRS_0054'])) { $PQRS_0054 = 1; } else { $PQRS_0054 = 0; }
if (isset($_REQUEST['PQRS_0065'])) { $PQRS_0065 = 1; } else { $PQRS_0065 = 0; }
if (isset($_REQUEST['PQRS_0066'])) { $PQRS_0066 = 1; } else { $PQRS_0066 = 0; }
if (isset($_REQUEST['PQRS_0067'])) { $PQRS_0067 = 1; } else { $PQRS_0067 = 0; }
if (isset($_REQUEST['PQRS_0068'])) { $PQRS_0068 = 1; } else { $PQRS_0068 = 0; }
if (isset($_REQUEST['PQRS_0069'])) { $PQRS_0069 = 1; } else { $PQRS_0069 = 0; }
if (isset($_REQUEST['PQRS_0070'])) { $PQRS_0070 = 1; } else { $PQRS_0070 = 0; }
if (isset($_REQUEST['PQRS_0071'])) { $PQRS_0071 = 1; } else { $PQRS_0071 = 0; } 
if (isset($_REQUEST['PQRS_0072'])) { $PQRS_0072 = 1; } else { $PQRS_0072 = 0; }
if (isset($_REQUEST['PQRS_0076'])) { $PQRS_0076 = 1; } else { $PQRS_0076 = 0; }
if (isset($_REQUEST['PQRS_0081'])) { $PQRS_0081 = 1; } else { $PQRS_0081 = 0; }
if (isset($_REQUEST['PQRS_0082'])) { $PQRS_0082 = 1; } else { $PQRS_0082 = 0; }
if (isset($_REQUEST['PQRS_0091'])) { $PQRS_0091 = 1; } else { $PQRS_0091 = 0; }
if (isset($_REQUEST['PQRS_0093'])) { $PQRS_0093 = 1; } else { $PQRS_0093 = 0; }
if (isset($_REQUEST['PQRS_0099'])) { $PQRS_0099 = 1; } else { $PQRS_0099 = 0; }
if (isset($_REQUEST['PQRS_0100'])) { $PQRS_0100 = 1; } else { $PQRS_0100 = 0; } 
if (isset($_REQUEST['PQRS_0102'])) { $PQRS_0102 = 1; } else { $PQRS_0102 = 0; }
if (isset($_REQUEST['PQRS_0104'])) { $PQRS_0104 = 1; } else { $PQRS_0104 = 0; }
if (isset($_REQUEST['PQRS_0109'])) { $PQRS_0109 = 1; } else { $PQRS_0109 = 0; }
if (isset($_REQUEST['PQRS_0110'])) { $PQRS_0110 = 1; } else { $PQRS_0110 = 0; }
if (isset($_REQUEST['PQRS_0111'])) { $PQRS_0111 = 1; } else { $PQRS_0111 = 0; }
if (isset($_REQUEST['PQRS_0112'])) { $PQRS_0112 = 1; } else { $PQRS_0112 = 0; }
if (isset($_REQUEST['PQRS_0113'])) { $PQRS_0113 = 1; } else { $PQRS_0113 = 0; }
if (isset($_REQUEST['PQRS_0116'])) { $PQRS_0116 = 1; } else { $PQRS_0116 = 0; } 
if (isset($_REQUEST['PQRS_0117'])) { $PQRS_0117 = 1; } else { $PQRS_0117 = 0; }
if (isset($_REQUEST['PQRS_0118'])) { $PQRS_0118 = 1; } else { $PQRS_0118 = 0; }
if (isset($_REQUEST['PQRS_0119'])) { $PQRS_0119 = 1; } else { $PQRS_0119 = 0; }
if (isset($_REQUEST['PQRS_0121'])) { $PQRS_0121 = 1; } else { $PQRS_0121 = 0; }
if (isset($_REQUEST['PQRS_0122'])) { $PQRS_0122 = 1; } else { $PQRS_0122 = 0; }
if (isset($_REQUEST['PQRS_0126'])) { $PQRS_0126 = 1; } else { $PQRS_0126 = 0; }
if (isset($_REQUEST['PQRS_0127'])) { $PQRS_0127 = 1; } else { $PQRS_0127 = 0; }
if (isset($_REQUEST['PQRS_0128'])) { $PQRS_0128 = 1; } else { $PQRS_0128 = 0; } 
if (isset($_REQUEST['PQRS_0130'])) { $PQRS_0130 = 1; } else { $PQRS_0130 = 0; }
if (isset($_REQUEST['PQRS_0131'])) { $PQRS_0131 = 1; } else { $PQRS_0131 = 0; }
if (isset($_REQUEST['PQRS_0134'])) { $PQRS_0134 = 1; } else { $PQRS_0134 = 0; }
if (isset($_REQUEST['PQRS_0137'])) { $PQRS_0137 = 1; } else { $PQRS_0137 = 0; }
if (isset($_REQUEST['PQRS_0138'])) { $PQRS_0138 = 1; } else { $PQRS_0138 = 0; }
if (isset($_REQUEST['PQRS_0140'])) { $PQRS_0140 = 1; } else { $PQRS_0140 = 0; }
if (isset($_REQUEST['PQRS_0141'])) { $PQRS_0141 = 1; } else { $PQRS_0141 = 0; }
if (isset($_REQUEST['PQRS_0143'])) { $PQRS_0143 = 1; } else { $PQRS_0143 = 0; } 
if (isset($_REQUEST['PQRS_0144'])) { $PQRS_0144 = 1; } else { $PQRS_0144 = 0; }
if (isset($_REQUEST['PQRS_0145'])) { $PQRS_0145 = 1; } else { $PQRS_0145 = 0; }
if (isset($_REQUEST['PQRS_0146'])) { $PQRS_0146 = 1; } else { $PQRS_0146 = 0; }
if (isset($_REQUEST['PQRS_0147'])) { $PQRS_0147 = 1; } else { $PQRS_0147 = 0; }
if (isset($_REQUEST['PQRS_0154'])) { $PQRS_0154 = 1; } else { $PQRS_0154 = 0; }
if (isset($_REQUEST['PQRS_0155'])) { $PQRS_0155 = 1; } else { $PQRS_0155 = 0; }
if (isset($_REQUEST['PQRS_0156'])) { $PQRS_0156 = 1; } else { $PQRS_0156 = 0; }
if (isset($_REQUEST['PQRS_0163'])) { $PQRS_0163 = 1; } else { $PQRS_0163 = 0; } 
if (isset($_REQUEST['PQRS_0164'])) { $PQRS_0164 = 1; } else { $PQRS_0164 = 0; }
if (isset($_REQUEST['PQRS_0165'])) { $PQRS_0165 = 1; } else { $PQRS_0165 = 0; }
if (isset($_REQUEST['PQRS_0166'])) { $PQRS_0166 = 1; } else { $PQRS_0166 = 0; }
if (isset($_REQUEST['PQRS_0167'])) { $PQRS_0167 = 1; } else { $PQRS_0167 = 0; }
if (isset($_REQUEST['PQRS_0168'])) { $PQRS_0168 = 1; } else { $PQRS_0168 = 0; }
if (isset($_REQUEST['PQRS_0172'])) { $PQRS_0172 = 1; } else { $PQRS_0172 = 0; }
if (isset($_REQUEST['PQRS_0173'])) { $PQRS_0173 = 1; } else { $PQRS_0173 = 0; }
if (isset($_REQUEST['PQRS_0178'])) { $PQRS_0178 = 1; } else { $PQRS_0178 = 0; } 
if (isset($_REQUEST['PQRS_0181'])) { $PQRS_0181 = 1; } else { $PQRS_0181 = 0; }
if (isset($_REQUEST['PQRS_0182'])) { $PQRS_0182 = 1; } else { $PQRS_0182 = 0; }
if (isset($_REQUEST['PQRS_0185'])) { $PQRS_0185 = 1; } else { $PQRS_0185 = 0; }
if (isset($_REQUEST['PQRS_0187'])) { $PQRS_0187 = 1; } else { $PQRS_0187 = 0; }
if (isset($_REQUEST['PQRS_0191'])) { $PQRS_0191 = 1; } else { $PQRS_0191 = 0; }
if (isset($_REQUEST['PQRS_0192'])) { $PQRS_0192 = 1; } else { $PQRS_0192 = 0; }
if (isset($_REQUEST['PQRS_0193'])) { $PQRS_0193 = 1; } else { $PQRS_0193 = 0; }
if (isset($_REQUEST['PQRS_0194'])) { $PQRS_0194 = 1; } else { $PQRS_0194 = 0; } 
if (isset($_REQUEST['PQRS_0195'])) { $PQRS_0195 = 1; } else { $PQRS_0195 = 0; }
if (isset($_REQUEST['PQRS_0204'])) { $PQRS_0204 = 1; } else { $PQRS_0204 = 0; }
if (isset($_REQUEST['PQRS_0205'])) { $PQRS_0205 = 1; } else { $PQRS_0205 = 0; }
if (isset($_REQUEST['PQRS_0217'])) { $PQRS_0217 = 1; } else { $PQRS_0217 = 0; }
if (isset($_REQUEST['PQRS_0218'])) { $PQRS_0218 = 1; } else { $PQRS_0218 = 0; }
if (isset($_REQUEST['PQRS_0219'])) { $PQRS_0219 = 1; } else { $PQRS_0219 = 0; }
if (isset($_REQUEST['PQRS_0220'])) { $PQRS_0220 = 1; } else { $PQRS_0220 = 0; }
if (isset($_REQUEST['PQRS_0221'])) { $PQRS_0221 = 1; } else { $PQRS_0221 = 0; } 
if (isset($_REQUEST['PQRS_0222'])) { $PQRS_0222 = 1; } else { $PQRS_0222 = 0; }
if (isset($_REQUEST['PQRS_0223'])) { $PQRS_0223 = 1; } else { $PQRS_0223 = 0; }
if (isset($_REQUEST['PQRS_0224'])) { $PQRS_0224 = 1; } else { $PQRS_0224 = 0; }
if (isset($_REQUEST['PQRS_0225'])) { $PQRS_0225 = 1; } else { $PQRS_0225 = 0; }
if (isset($_REQUEST['PQRS_0226'])) { $PQRS_0226 = 1; } else { $PQRS_0226 = 0; }
if (isset($_REQUEST['PQRS_0236'])) { $PQRS_0236 = 1; } else { $PQRS_0236 = 0; }
if (isset($_REQUEST['PQRS_0238'])) { $PQRS_0238 = 1; } else { $PQRS_0238 = 0; }
if (isset($_REQUEST['PQRS_0242'])) { $PQRS_0242 = 1; } else { $PQRS_0242 = 0; } 
if (isset($_REQUEST['PQRS_0243'])) { $PQRS_0243 = 1; } else { $PQRS_0243 = 0; }
if (isset($_REQUEST['PQRS_0249'])) { $PQRS_0249 = 1; } else { $PQRS_0249 = 0; }
if (isset($_REQUEST['PQRS_0250'])) { $PQRS_0250 = 1; } else { $PQRS_0250 = 0; }
if (isset($_REQUEST['PQRS_0251'])) { $PQRS_0251 = 1; } else { $PQRS_0251 = 0; }
if (isset($_REQUEST['PQRS_0254'])) { $PQRS_0254 = 1; } else { $PQRS_0254 = 0; }
if (isset($_REQUEST['PQRS_0255'])) { $PQRS_0255 = 1; } else { $PQRS_0255 = 0; }
if (isset($_REQUEST['PQRS_0257'])) { $PQRS_0257 = 1; } else { $PQRS_0257 = 0; }
if (isset($_REQUEST['PQRS_0258'])) { $PQRS_0258 = 1; } else { $PQRS_0258 = 0; } 
if (isset($_REQUEST['PQRS_0259'])) { $PQRS_0259 = 1; } else { $PQRS_0259 = 0; }
if (isset($_REQUEST['PQRS_0260'])) { $PQRS_0260 = 1; } else { $PQRS_0260 = 0; }
if (isset($_REQUEST['PQRS_0261'])) { $PQRS_0261 = 1; } else { $PQRS_0261 = 0; }
if (isset($_REQUEST['PQRS_0262'])) { $PQRS_0262 = 1; } else { $PQRS_0262 = 0; }
if (isset($_REQUEST['PQRS_0263'])) { $PQRS_0263 = 1; } else { $PQRS_0263 = 0; }
if (isset($_REQUEST['PQRS_0264'])) { $PQRS_0264 = 1; } else { $PQRS_0264 = 0; }
if (isset($_REQUEST['PQRS_0265'])) { $PQRS_0265 = 1; } else { $PQRS_0265 = 0; }
if (isset($_REQUEST['PQRS_0268'])) { $PQRS_0268 = 1; } else { $PQRS_0268 = 0; } 
if (isset($_REQUEST['PQRS_0270'])) { $PQRS_0270 = 1; } else { $PQRS_0270 = 0; }
if (isset($_REQUEST['PQRS_0271'])) { $PQRS_0271 = 1; } else { $PQRS_0271 = 0; }
if (isset($_REQUEST['PQRS_0274'])) { $PQRS_0274 = 1; } else { $PQRS_0274 = 0; }
if (isset($_REQUEST['PQRS_0275'])) { $PQRS_0275 = 1; } else { $PQRS_0275 = 0; }
if (isset($_REQUEST['PQRS_0303'])) { $PQRS_0303 = 1; } else { $PQRS_0303 = 0; }
if (isset($_REQUEST['PQRS_0304'])) { $PQRS_0304 = 1; } else { $PQRS_0304 = 0; }
if (isset($_REQUEST['PQRS_0317'])) { $PQRS_0317 = 1; } else { $PQRS_0317 = 0; }
if (isset($_REQUEST['PQRS_0320'])) { $PQRS_0320 = 1; } else { $PQRS_0320 = 0; } 
if (isset($_REQUEST['PQRS_0322'])) { $PQRS_0322 = 1; } else { $PQRS_0322 = 0; }
if (isset($_REQUEST['PQRS_0323'])) { $PQRS_0323 = 1; } else { $PQRS_0323 = 0; }
if (isset($_REQUEST['PQRS_0324'])) { $PQRS_0324 = 1; } else { $PQRS_0324 = 0; }
if (isset($_REQUEST['PQRS_0325'])) { $PQRS_0325 = 1; } else { $PQRS_0325 = 0; }
if (isset($_REQUEST['PQRS_0326'])) { $PQRS_0326 = 1; } else { $PQRS_0326 = 0; }
if (isset($_REQUEST['PQRS_0327'])) { $PQRS_0327 = 1; } else { $PQRS_0327 = 0; }
if (isset($_REQUEST['PQRS_0328'])) { $PQRS_0328 = 1; } else { $PQRS_0328 = 0; }
if (isset($_REQUEST['PQRS_0329'])) { $PQRS_0329 = 1; } else { $PQRS_0329 = 0; } 
if (isset($_REQUEST['PQRS_0330'])) { $PQRS_0330 = 1; } else { $PQRS_0330 = 0; }
if (isset($_REQUEST['PQRS_0331'])) { $PQRS_0331 = 1; } else { $PQRS_0331 = 0; }
if (isset($_REQUEST['PQRS_0332'])) { $PQRS_0332 = 1; } else { $PQRS_0332 = 0; }
if (isset($_REQUEST['PQRS_0333'])) { $PQRS_0333 = 1; } else { $PQRS_0333 = 0; }
if (isset($_REQUEST['PQRS_0334'])) { $PQRS_0334 = 1; } else { $PQRS_0334 = 0; }
if (isset($_REQUEST['PQRS_0335'])) { $PQRS_0335 = 1; } else { $PQRS_0335 = 0; }
if (isset($_REQUEST['PQRS_0336'])) { $PQRS_0336 = 1; } else { $PQRS_0336 = 0; }
if (isset($_REQUEST['PQRS_0337'])) { $PQRS_0337 = 1; } else { $PQRS_0337 = 0; } 
if (isset($_REQUEST['PQRS_0342'])) { $PQRS_0342 = 1; } else { $PQRS_0342 = 0; }
if (isset($_REQUEST['PQRS_0343'])) { $PQRS_0343 = 1; } else { $PQRS_0343 = 0; }
if (isset($_REQUEST['PQRS_0344'])) { $PQRS_0344 = 1; } else { $PQRS_0344 = 0; }
if (isset($_REQUEST['PQRS_0345'])) { $PQRS_0345 = 1; } else { $PQRS_0345 = 0; }
if (isset($_REQUEST['PQRS_0346'])) { $PQRS_0346 = 1; } else { $PQRS_0346 = 0; }
if (isset($_REQUEST['PQRS_0347'])) { $PQRS_0347 = 1; } else { $PQRS_0347 = 0; }
if (isset($_REQUEST['PQRS_0348'])) { $PQRS_0348 = 1; } else { $PQRS_0348 = 0; }
if (isset($_REQUEST['PQRS_0349'])) { $PQRS_0349 = 1; } else { $PQRS_0349 = 0; } 
if (isset($_REQUEST['PQRS_0358'])) { $PQRS_0358 = 1; } else { $PQRS_0358 = 0; }
if (isset($_REQUEST['PQRS_0383'])) { $PQRS_0383 = 1; } else { $PQRS_0383 = 0; }
if (isset($_REQUEST['PQRS_0384'])) { $PQRS_0384 = 1; } else { $PQRS_0384 = 0; }
if (isset($_REQUEST['PQRS_0385'])) { $PQRS_0385 = 1; } else { $PQRS_0385 = 0; }
if (isset($_REQUEST['PQRS_0386'])) { $PQRS_0386 = 1; } else { $PQRS_0386 = 0; }
if (isset($_REQUEST['PQRS_0387'])) { $PQRS_0387 = 1; } else { $PQRS_0387 = 0; }
if (isset($_REQUEST['PQRS_0388'])) { $PQRS_0388 = 1; } else { $PQRS_0388 = 0; }
if (isset($_REQUEST['PQRS_0389'])) { $PQRS_0389 = 1; } else { $PQRS_0389 = 0; } 
if (isset($_REQUEST['PQRS_0390'])) { $PQRS_0390 = 1; } else { $PQRS_0390 = 0; }
if (isset($_REQUEST['PQRS_0391'])) { $PQRS_0391 = 1; } else { $PQRS_0391 = 0; }
if (isset($_REQUEST['PQRS_0392'])) { $PQRS_0392 = 1; } else { $PQRS_0392 = 0; }
if (isset($_REQUEST['PQRS_0393'])) { $PQRS_0393 = 1; } else { $PQRS_0393 = 0; }
if (isset($_REQUEST['PQRS_0394'])) { $PQRS_0394 = 1; } else { $PQRS_0394 = 0; }
if (isset($_REQUEST['PQRS_0395'])) { $PQRS_0395 = 1; } else { $PQRS_0395 = 0; }
if (isset($_REQUEST['PQRS_0396'])) { $PQRS_0396 = 1; } else { $PQRS_0396 = 0; }
if (isset($_REQUEST['PQRS_0397'])) { $PQRS_0397 = 1; } else { $PQRS_0397 = 0; } 
if (isset($_REQUEST['PQRS_0398'])) { $PQRS_0398 = 1; } else { $PQRS_0398 = 0; }
if (isset($_REQUEST['PQRS_0399'])) { $PQRS_0399 = 1; } else { $PQRS_0399 = 0; }
if (isset($_REQUEST['PQRS_0400'])) { $PQRS_0400 = 1; } else { $PQRS_0400 = 0; }
if (isset($_REQUEST['PQRS_0401'])) { $PQRS_0401 = 1; } else { $PQRS_0401 = 0; }
if (isset($_REQUEST['PQRS_0402'])) { $PQRS_0402 = 1; } else { $PQRS_0402 = 0; }
if (isset($_REQUEST['PQRS_always_met'])) { $PQRS_always_met = 1; } else { $PQRS_always_met = 0; }
if (isset($_REQUEST['PQRS_Group_AOE_0091'])) { $PQRS_Group_AOE_0091 = 1; } else { $PQRS_Group_AOE_0091 = 0; }
if (isset($_REQUEST['PQRS_Group_AOE_0093'])) { $PQRS_Group_AOE_0093 = 1; } else { $PQRS_Group_AOE_0093 = 0; } 
if (isset($_REQUEST['PQRS_Group_AOE_0130'])) { $PQRS_Group_AOE_0130 = 1; } else { $PQRS_Group_AOE_0130 = 0; }
if (isset($_REQUEST['PQRS_Group_AOE_0131'])) { $PQRS_Group_AOE_0131 = 1; } else { $PQRS_Group_AOE_0131 = 0; }
if (isset($_REQUEST['PQRS_Group_AOE_0154'])) { $PQRS_Group_AOE_0154 = 1; } else { $PQRS_Group_AOE_0154 = 0; }
if (isset($_REQUEST['PQRS_Group_AOE_0155'])) { $PQRS_Group_AOE_0155 = 1; } else { $PQRS_Group_AOE_0155 = 0; }
if (isset($_REQUEST['PQRS_Group_AOE_0226'])) { $PQRS_Group_AOE_0226 = 1; } else { $PQRS_Group_AOE_0226 = 0; }
if (isset($_REQUEST['PQRS_Group_AOE_0317'])) { $PQRS_Group_AOE_0317 = 1; } else { $PQRS_Group_AOE_0317 = 0; }
if (isset($_REQUEST['PQRS_Group_Asthma_0053'])) { $PQRS_Group_Asthma_0053= 1; } else { $PQRS_Group_Asthma_0053= 0; }
if (isset($_REQUEST['PQRS_Group_Asthma_0110'])) { $PQRS_Group_Asthma_0110= 1; } else { $PQRS_Group_Asthma_0110= 0; } 
if (isset($_REQUEST['PQRS_Group_Asthma_0128'])) { $PQRS_Group_Asthma_0128= 1; } else { $PQRS_Group_Asthma_0128= 0; }
if (isset($_REQUEST['PQRS_Group_Asthma_0130'])) { $PQRS_Group_Asthma_0130= 1; } else { $PQRS_Group_Asthma_0130= 0; }
if (isset($_REQUEST['PQRS_Group_Asthma_0226'])) { $PQRS_Group_Asthma_0226= 1; } else { $PQRS_Group_Asthma_0226= 0; }
if (isset($_REQUEST['PQRS_Group_Asthma_0402'])) { $PQRS_Group_Asthma_0402= 1; } else { $PQRS_Group_Asthma_0402= 0; }
if (isset($_REQUEST['PQRS_Group_CABG_0043'])) { $PQRS_Group_CABG_0043= 1; } else { $PQRS_Group_CABG_0043= 0; }
if (isset($_REQUEST['PQRS_Group_CABG_0044'])) { $PQRS_Group_CABG_0044= 1; } else { $PQRS_Group_CABG_0044= 0; }
if (isset($_REQUEST['PQRS_Group_CABG_0164'])) { $PQRS_Group_CABG_0164= 1; } else { $PQRS_Group_CABG_0164= 0; }
if (isset($_REQUEST['PQRS_Group_CABG_0165'])) { $PQRS_Group_CABG_0165= 1; } else { $PQRS_Group_CABG_0165= 0; } 
if (isset($_REQUEST['PQRS_Group_CABG_0166'])) { $PQRS_Group_CABG_0166= 1; } else { $PQRS_Group_CABG_0166= 0; }
if (isset($_REQUEST['PQRS_Group_CABG_0167'])) { $PQRS_Group_CABG_0167= 1; } else { $PQRS_Group_CABG_0167= 0; }
if (isset($_REQUEST['PQRS_Group_CABG_0168'])) { $PQRS_Group_CABG_0168= 1; } else { $PQRS_Group_CABG_0168= 0; }
if (isset($_REQUEST['PQRS_Group_CAD_0006'])) { $PQRS_Group_CAD_0006 = 1; } else { $PQRS_Group_CAD_0006 = 0; }
if (isset($_REQUEST['PQRS_Group_CAD_0007'])) { $PQRS_Group_CAD_0007 = 1; } else { $PQRS_Group_CAD_0007 = 0; }
if (isset($_REQUEST['PQRS_Group_CAD_0128'])) { $PQRS_Group_CAD_0128 = 1; } else { $PQRS_Group_CAD_0128 = 0; }
if (isset($_REQUEST['PQRS_Group_CAD_0130'])) { $PQRS_Group_CAD_0130 = 1; } else { $PQRS_Group_CAD_0130 = 0; }
if (isset($_REQUEST['PQRS_Group_CAD_0226'])) { $PQRS_Group_CAD_0226 = 1; } else { $PQRS_Group_CAD_0226 = 0; } 
if (isset($_REQUEST['PQRS_Group_CAD_0242'])) { $PQRS_Group_CAD_0242 = 1; } else { $PQRS_Group_CAD_0242 = 0; }
if (isset($_REQUEST['PQRS_Group_Cataracts_0130'])) { $PQRS_Group_Cataracts_0130 = 1; } else { $PQRS_Group_Cataracts_0130 = 0; }
if (isset($_REQUEST['PQRS_Group_Cataracts_0191'])) { $PQRS_Group_Cataracts_0191 = 1; } else { $PQRS_Group_Cataracts_0191 = 0; }
if (isset($_REQUEST['PQRS_Group_Cataracts_0192'])) { $PQRS_Group_Cataracts_0192 = 1; } else { $PQRS_Group_Cataracts_0192 = 0; }
if (isset($_REQUEST['PQRS_Group_Cataracts_0226'])) { $PQRS_Group_Cataracts_0226 = 1; } else { $PQRS_Group_Cataracts_0226 = 0; }
if (isset($_REQUEST['PQRS_Group_Cataracts_0303'])) { $PQRS_Group_Cataracts_0303 = 1; } else { $PQRS_Group_Cataracts_0303 = 0; }
if (isset($_REQUEST['PQRS_Group_Cataracts_0304'])) { $PQRS_Group_Cataracts_0304 = 1; } else { $PQRS_Group_Cataracts_0304 = 0; }
if (isset($_REQUEST['PQRS_Group_Cataracts_0388'])) { $PQRS_Group_Cataracts_0388 = 1; } else { $PQRS_Group_Cataracts_0388 = 0; } 
if (isset($_REQUEST['PQRS_Group_Cataracts_0389'])) { $PQRS_Group_Cataracts_0389 = 1; } else { $PQRS_Group_Cataracts_0389 = 0; }
if (isset($_REQUEST['PQRS_Group_CKD_0047'])) { $PQRS_Group_CKD_0047 = 1; } else { $PQRS_Group_CKD_0047 = 0; }
if (isset($_REQUEST['PQRS_Group_CKD_0110'])) { $PQRS_Group_CKD_0110 = 1; } else { $PQRS_Group_CKD_0110 = 0; }
if (isset($_REQUEST['PQRS_Group_CKD_0121'])) { $PQRS_Group_CKD_0121 = 1; } else { $PQRS_Group_CKD_0121 = 0; }
if (isset($_REQUEST['PQRS_Group_CKD_0122'])) { $PQRS_Group_CKD_0122 = 1; } else { $PQRS_Group_CKD_0122 = 0; }
if (isset($_REQUEST['PQRS_Group_CKD_0130'])) { $PQRS_Group_CKD_0130 = 1; } else { $PQRS_Group_CKD_0130 = 0; }
if (isset($_REQUEST['PQRS_Group_CKD_0226'])) { $PQRS_Group_CKD_0226 = 1; } else { $PQRS_Group_CKD_0226 = 0; }
if (isset($_REQUEST['PQRS_Group_COPD_0047'])) { $PQRS_Group_COPD_0047= 1; } else { $PQRS_Group_COPD_0047= 0; } 
if (isset($_REQUEST['PQRS_Group_COPD_0051'])) { $PQRS_Group_COPD_0051= 1; } else { $PQRS_Group_COPD_0051= 0; }
if (isset($_REQUEST['PQRS_Group_COPD_0052'])) { $PQRS_Group_COPD_0052= 1; } else { $PQRS_Group_COPD_0052= 0; }
if (isset($_REQUEST['PQRS_Group_COPD_0110'])) { $PQRS_Group_COPD_0110= 1; } else { $PQRS_Group_COPD_0110= 0; }
if (isset($_REQUEST['PQRS_Group_COPD_0111'])) { $PQRS_Group_COPD_0111= 1; } else { $PQRS_Group_COPD_0111= 0; }
if (isset($_REQUEST['PQRS_Group_COPD_0130'])) { $PQRS_Group_COPD_0130= 1; } else { $PQRS_Group_COPD_0130= 0; }
if (isset($_REQUEST['PQRS_Group_COPD_0226'])) { $PQRS_Group_COPD_0226= 1; } else { $PQRS_Group_COPD_0226= 0; }
if (isset($_REQUEST['PQRS_Group_Dementia_0047'])) { $PQRS_Group_Dementia_0047= 1; } else { $PQRS_Group_Dementia_0047= 0; }
if (isset($_REQUEST['PQRS_Group_Dementia_0280'])) { $PQRS_Group_Dementia_0280= 1; } else { $PQRS_Group_Dementia_0280= 0; } 
if (isset($_REQUEST['PQRS_Group_Dementia_0281'])) { $PQRS_Group_Dementia_0281= 1; } else { $PQRS_Group_Dementia_0281= 0; }
if (isset($_REQUEST['PQRS_Group_Dementia_0282'])) { $PQRS_Group_Dementia_0282= 1; } else { $PQRS_Group_Dementia_0282= 0; }
if (isset($_REQUEST['PQRS_Group_Dementia_0283'])) { $PQRS_Group_Dementia_0283= 1; } else { $PQRS_Group_Dementia_0283= 0; }
if (isset($_REQUEST['PQRS_Group_Dementia_0284'])) { $PQRS_Group_Dementia_0284= 1; } else { $PQRS_Group_Dementia_0284= 0; }
if (isset($_REQUEST['PQRS_Group_Dementia_0285'])) { $PQRS_Group_Dementia_0285= 1; } else { $PQRS_Group_Dementia_0285= 0; }
if (isset($_REQUEST['PQRS_Group_Dementia_0286'])) { $PQRS_Group_Dementia_0286= 1; } else { $PQRS_Group_Dementia_0286= 0; }
if (isset($_REQUEST['PQRS_Group_Dementia_0287'])) { $PQRS_Group_Dementia_0287= 1; } else { $PQRS_Group_Dementia_0287= 0; }
if (isset($_REQUEST['PQRS_Group_Dementia_0288'])) { $PQRS_Group_Dementia_0288= 1; } else { $PQRS_Group_Dementia_0288= 0; } 
if (isset($_REQUEST['PQRS_Group_Diabetes_0001'])) { $PQRS_Group_Diabetes_0001= 1; } else { $PQRS_Group_Diabetes_0001= 0; }
if (isset($_REQUEST['PQRS_Group_Diabetes_0110'])) { $PQRS_Group_Diabetes_0110= 1; } else { $PQRS_Group_Diabetes_0110= 0; }
if (isset($_REQUEST['PQRS_Group_Diabetes_0117'])) { $PQRS_Group_Diabetes_0117= 1; } else { $PQRS_Group_Diabetes_0117= 0; }
if (isset($_REQUEST['PQRS_Group_Diabetes_0119'])) { $PQRS_Group_Diabetes_0119= 1; } else { $PQRS_Group_Diabetes_0119= 0; }
if (isset($_REQUEST['PQRS_Group_Diabetes_0163'])) { $PQRS_Group_Diabetes_0163= 1; } else { $PQRS_Group_Diabetes_0163= 0; }
if (isset($_REQUEST['PQRS_Group_Diabetes_0226'])) { $PQRS_Group_Diabetes_0226= 1; } else { $PQRS_Group_Diabetes_0226= 0; }
if (isset($_REQUEST['PQRS_Group_General_Surgery_0130'])) { $PQRS_Group_General_Surgery_0130 = 1; } else { $PQRS_Group_General_Surgery_0130 = 0; }
if (isset($_REQUEST['PQRS_Group_General_Surgery_0226'])) { $PQRS_Group_General_Surgery_0226 = 1; } else { $PQRS_Group_General_Surgery_0226 = 0; } 
if (isset($_REQUEST['PQRS_Group_General_Surgery_0354'])) { $PQRS_Group_General_Surgery_0354 = 1; } else { $PQRS_Group_General_Surgery_0354 = 0; }
if (isset($_REQUEST['PQRS_Group_General_Surgery_0355'])) { $PQRS_Group_General_Surgery_0355 = 1; } else { $PQRS_Group_General_Surgery_0355 = 0; }
if (isset($_REQUEST['PQRS_Group_General_Surgery_0356'])) { $PQRS_Group_General_Surgery_0356 = 1; } else { $PQRS_Group_General_Surgery_0356 = 0; }
if (isset($_REQUEST['PQRS_Group_General_Surgery_0357'])) { $PQRS_Group_General_Surgery_0357 = 1; } else { $PQRS_Group_General_Surgery_0357 = 0; }
if (isset($_REQUEST['PQRS_Group_General_Surgery_0358'])) { $PQRS_Group_General_Surgery_0358 = 1; } else { $PQRS_Group_General_Surgery_0358 = 0; }
if (isset($_REQUEST['PQRS_Group_HepatitisC_0084'])) { $PQRS_Group_HepatitisC_0084= 1; } else { $PQRS_Group_HepatitisC_0084= 0; }
if (isset($_REQUEST['PQRS_Group_HepatitisC_0085'])) { $PQRS_Group_HepatitisC_0085= 1; } else { $PQRS_Group_HepatitisC_0085= 0; }
if (isset($_REQUEST['PQRS_Group_HepatitisC_0087'])) { $PQRS_Group_HepatitisC_0087= 1; } else { $PQRS_Group_HepatitisC_0087= 0; } 
if (isset($_REQUEST['PQRS_Group_HepatitisC_0130'])) { $PQRS_Group_HepatitisC_0130= 1; } else { $PQRS_Group_HepatitisC_0130= 0; }
if (isset($_REQUEST['PQRS_Group_HepatitisC_0183'])) { $PQRS_Group_HepatitisC_0183= 1; } else { $PQRS_Group_HepatitisC_0183= 0; }
if (isset($_REQUEST['PQRS_Group_HepatitisC_0226'])) { $PQRS_Group_HepatitisC_0226= 1; } else { $PQRS_Group_HepatitisC_0226= 0; }
if (isset($_REQUEST['PQRS_Group_HepatitisC_0390'])) { $PQRS_Group_HepatitisC_0390= 1; } else { $PQRS_Group_HepatitisC_0390= 0; }
if (isset($_REQUEST['PQRS_Group_HepatitisC_0401'])) { $PQRS_Group_HepatitisC_0401= 1; } else { $PQRS_Group_HepatitisC_0401= 0; }
if (isset($_REQUEST['PQRS_Group_HF_0005'])) { $PQRS_Group_HF_0005= 1; } else { $PQRS_Group_HF_0005= 0; }
if (isset($_REQUEST['PQRS_Group_HF_0008'])) { $PQRS_Group_HF_0008= 1; } else { $PQRS_Group_HF_0008= 0; }
if (isset($_REQUEST['PQRS_Group_HF_0047'])) { $PQRS_Group_HF_0047= 1; } else { $PQRS_Group_HF_0047= 0; } 
if (isset($_REQUEST['PQRS_Group_HF_0110'])) { $PQRS_Group_HF_0110= 1; } else { $PQRS_Group_HF_0110= 0; }
if (isset($_REQUEST['PQRS_Group_HF_0130'])) { $PQRS_Group_HF_0130= 1; } else { $PQRS_Group_HF_0130= 0; }
if (isset($_REQUEST['PQRS_Group_HF_0226'])) { $PQRS_Group_HF_0226= 1; } else { $PQRS_Group_HF_0226= 0; }
if (isset($_REQUEST['PQRS_Group_HIVAIDS_0047'])) { $PQRS_Group_HIVAIDS_0047 = 1; } else { $PQRS_Group_HIVAIDS_0047 = 0; }
if (isset($_REQUEST['PQRS_Group_HIVAIDS_0134'])) { $PQRS_Group_HIVAIDS_0134 = 1; } else { $PQRS_Group_HIVAIDS_0134 = 0; }
if (isset($_REQUEST['PQRS_Group_HIVAIDS_0160'])) { $PQRS_Group_HIVAIDS_0160 = 1; } else { $PQRS_Group_HIVAIDS_0160 = 0; }
if (isset($_REQUEST['PQRS_Group_HIVAIDS_0205'])) { $PQRS_Group_HIVAIDS_0205 = 1; } else { $PQRS_Group_HIVAIDS_0205 = 0; }
if (isset($_REQUEST['PQRS_Group_HIVAIDS_0226'])) { $PQRS_Group_HIVAIDS_0226 = 1; } else { $PQRS_Group_HIVAIDS_0226 = 0; } 
if (isset($_REQUEST['PQRS_Group_HIVAIDS_0338'])) { $PQRS_Group_HIVAIDS_0338 = 1; } else { $PQRS_Group_HIVAIDS_0338 = 0; }
if (isset($_REQUEST['PQRS_Group_HIVAIDS_0339'])) { $PQRS_Group_HIVAIDS_0339 = 1; } else { $PQRS_Group_HIVAIDS_0339 = 0; }
if (isset($_REQUEST['PQRS_Group_HIVAIDS_0340'])) { $PQRS_Group_HIVAIDS_0340 = 1; } else { $PQRS_Group_HIVAIDS_0340 = 0; }
if (isset($_REQUEST['PQRS_Group_IBD_0110'])) { $PQRS_Group_IBD_0110 = 1; } else { $PQRS_Group_IBD_0110 = 0; }
if (isset($_REQUEST['PQRS_Group_IBD_0111'])) { $PQRS_Group_IBD_0111 = 1; } else { $PQRS_Group_IBD_0111 = 0; }
if (isset($_REQUEST['PQRS_Group_IBD_0226'])) { $PQRS_Group_IBD_0226 = 1; } else { $PQRS_Group_IBD_0226 = 0; }
if (isset($_REQUEST['PQRS_Group_IBD_0270'])) { $PQRS_Group_IBD_0270 = 1; } else { $PQRS_Group_IBD_0270 = 0; }
if (isset($_REQUEST['PQRS_Group_IBD_0271'])) { $PQRS_Group_IBD_0271 = 1; } else { $PQRS_Group_IBD_0271 = 0; } 
if (isset($_REQUEST['PQRS_Group_IBD_0274'])) { $PQRS_Group_IBD_0274 = 1; } else { $PQRS_Group_IBD_0274 = 0; }
if (isset($_REQUEST['PQRS_Group_IBD_0275'])) { $PQRS_Group_IBD_0275 = 1; } else { $PQRS_Group_IBD_0275 = 0; }
if (isset($_REQUEST['PQRS_Group_Oncology_0071'])) { $PQRS_Group_Oncology_0071= 1; } else { $PQRS_Group_Oncology_0071= 0; }
if (isset($_REQUEST['PQRS_Group_Oncology_0072'])) { $PQRS_Group_Oncology_0072= 1; } else { $PQRS_Group_Oncology_0072= 0; }
if (isset($_REQUEST['PQRS_Group_Oncology_0110'])) { $PQRS_Group_Oncology_0110= 1; } else { $PQRS_Group_Oncology_0110= 0; }
if (isset($_REQUEST['PQRS_Group_Oncology_0130'])) { $PQRS_Group_Oncology_0130= 1; } else { $PQRS_Group_Oncology_0130= 0; }
if (isset($_REQUEST['PQRS_Group_Oncology_0143'])) { $PQRS_Group_Oncology_0143= 1; } else { $PQRS_Group_Oncology_0143= 0; }
if (isset($_REQUEST['PQRS_Group_Oncology_0144'])) { $PQRS_Group_Oncology_0144= 1; } else { $PQRS_Group_Oncology_0144= 0; } 
if (isset($_REQUEST['PQRS_Group_Oncology_0226'])) { $PQRS_Group_Oncology_0226= 1; } else { $PQRS_Group_Oncology_0226= 0; }
if (isset($_REQUEST['PQRS_Group_OPEIR_0359'])) { $PQRS_Group_OPEIR_0359 = 1; } else { $PQRS_Group_OPEIR_0359 = 0; }
if (isset($_REQUEST['PQRS_Group_OPEIR_0360'])) { $PQRS_Group_OPEIR_0360 = 1; } else { $PQRS_Group_OPEIR_0360 = 0; }
if (isset($_REQUEST['PQRS_Group_OPEIR_0361'])) { $PQRS_Group_OPEIR_0361 = 1; } else { $PQRS_Group_OPEIR_0361 = 0; }
if (isset($_REQUEST['PQRS_Group_OPEIR_0362'])) { $PQRS_Group_OPEIR_0362 = 1; } else { $PQRS_Group_OPEIR_0362 = 0; }
if (isset($_REQUEST['PQRS_Group_OPEIR_0363'])) { $PQRS_Group_OPEIR_0363 = 1; } else { $PQRS_Group_OPEIR_0363 = 0; }
if (isset($_REQUEST['PQRS_Group_OPEIR_0364'])) { $PQRS_Group_OPEIR_0364 = 1; } else { $PQRS_Group_OPEIR_0364 = 0; }
if (isset($_REQUEST['PQRS_Group_Parkinsons_0047'])) { $PQRS_Group_Parkinsons_0047= 1; } else { $PQRS_Group_Parkinsons_0047= 0; } 
if (isset($_REQUEST['PQRS_Group_Parkinsons_0289'])) { $PQRS_Group_Parkinsons_0289= 1; } else { $PQRS_Group_Parkinsons_0289= 0; }
if (isset($_REQUEST['PQRS_Group_Parkinsons_0290'])) { $PQRS_Group_Parkinsons_0290= 1; } else { $PQRS_Group_Parkinsons_0290= 0; }
if (isset($_REQUEST['PQRS_Group_Parkinsons_0291'])) { $PQRS_Group_Parkinsons_0291= 1; } else { $PQRS_Group_Parkinsons_0291= 0; }
if (isset($_REQUEST['PQRS_Group_Parkinsons_0292'])) { $PQRS_Group_Parkinsons_0292= 1; } else { $PQRS_Group_Parkinsons_0292= 0; }
if (isset($_REQUEST['PQRS_Group_Parkinsons_0293'])) { $PQRS_Group_Parkinsons_0293= 1; } else { $PQRS_Group_Parkinsons_0293= 0; }
if (isset($_REQUEST['PQRS_Group_Parkinsons_0294'])) { $PQRS_Group_Parkinsons_0294= 1; } else { $PQRS_Group_Parkinsons_0294= 0; }
if (isset($_REQUEST['PQRS_Group_Preventive_0039'])) { $PQRS_Group_Preventive_0039= 1; } else { $PQRS_Group_Preventive_0039= 0; }
if (isset($_REQUEST['PQRS_Group_Preventive_0048'])) { $PQRS_Group_Preventive_0048= 1; } else { $PQRS_Group_Preventive_0048= 0; } 
if (isset($_REQUEST['PQRS_Group_Preventive_0110'])) { $PQRS_Group_Preventive_0110= 1; } else { $PQRS_Group_Preventive_0110= 0; }
if (isset($_REQUEST['PQRS_Group_Preventive_0111'])) { $PQRS_Group_Preventive_0111= 1; } else { $PQRS_Group_Preventive_0111= 0; }
if (isset($_REQUEST['PQRS_Group_Preventive_0112'])) { $PQRS_Group_Preventive_0112= 1; } else { $PQRS_Group_Preventive_0112= 0; }
if (isset($_REQUEST['PQRS_Group_Preventive_0113'])) { $PQRS_Group_Preventive_0113= 1; } else { $PQRS_Group_Preventive_0113= 0; }
if (isset($_REQUEST['PQRS_Group_Preventive_0128'])) { $PQRS_Group_Preventive_0128= 1; } else { $PQRS_Group_Preventive_0128= 0; }
if (isset($_REQUEST['PQRS_Group_Preventive_0134'])) { $PQRS_Group_Preventive_0134= 1; } else { $PQRS_Group_Preventive_0134= 0; }
if (isset($_REQUEST['PQRS_Group_Preventive_0226'])) { $PQRS_Group_Preventive_0226= 1; } else { $PQRS_Group_Preventive_0226= 0; }
if (isset($_REQUEST['PQRS_Group_RA_0108'])) { $PQRS_Group_RA_0108= 1; } else { $PQRS_Group_RA_0108= 0; } 
if (isset($_REQUEST['PQRS_Group_RA_0128'])) { $PQRS_Group_RA_0128= 1; } else { $PQRS_Group_RA_0128= 0; }
if (isset($_REQUEST['PQRS_Group_RA_0131'])) { $PQRS_Group_RA_0131= 1; } else { $PQRS_Group_RA_0131= 0; }
if (isset($_REQUEST['PQRS_Group_RA_0176'])) { $PQRS_Group_RA_0176= 1; } else { $PQRS_Group_RA_0176= 0; }
if (isset($_REQUEST['PQRS_Group_RA_0177'])) { $PQRS_Group_RA_0177= 1; } else { $PQRS_Group_RA_0177= 0; }
if (isset($_REQUEST['PQRS_Group_RA_0178'])) { $PQRS_Group_RA_0178= 1; } else { $PQRS_Group_RA_0178= 0; }
if (isset($_REQUEST['PQRS_Group_RA_0179'])) { $PQRS_Group_RA_0179= 1; } else { $PQRS_Group_RA_0179= 0; }
if (isset($_REQUEST['PQRS_Group_RA_0180'])) { $PQRS_Group_RA_0180= 1; } else { $PQRS_Group_RA_0180= 0; }
if (isset($_REQUEST['PQRS_Group_Sinusitis_0130'])) { $PQRS_Group_Sinusitis_0130 = 1; } else { $PQRS_Group_Sinusitis_0130 = 0; } 
if (isset($_REQUEST['PQRS_Group_Sinusitis_0131'])) { $PQRS_Group_Sinusitis_0131 = 1; } else { $PQRS_Group_Sinusitis_0131 = 0; }
if (isset($_REQUEST['PQRS_Group_Sinusitis_0226'])) { $PQRS_Group_Sinusitis_0226 = 1; } else { $PQRS_Group_Sinusitis_0226 = 0; }
if (isset($_REQUEST['PQRS_Group_Sinusitis_0331'])) { $PQRS_Group_Sinusitis_0331 = 1; } else { $PQRS_Group_Sinusitis_0331 = 0; }
if (isset($_REQUEST['PQRS_Group_Sinusitis_0332'])) { $PQRS_Group_Sinusitis_0332 = 1; } else { $PQRS_Group_Sinusitis_0332 = 0; }
if (isset($_REQUEST['PQRS_Group_Sinusitis_0333'])) { $PQRS_Group_Sinusitis_0333 = 1; } else { $PQRS_Group_Sinusitis_0333 = 0; }
if (isset($_REQUEST['PQRS_Group_Sleep_Apnea_0128'])) { $PQRS_Group_Sleep_Apnea_0128 = 1; } else { $PQRS_Group_Sleep_Apnea_0128 = 0; }
if (isset($_REQUEST['PQRS_Group_Sleep_Apnea_0130'])) { $PQRS_Group_Sleep_Apnea_0130 = 1; } else { $PQRS_Group_Sleep_Apnea_0130 = 0; }
if (isset($_REQUEST['PQRS_Group_Sleep_Apnea_0226'])) { $PQRS_Group_Sleep_Apnea_0226 = 1; } else { $PQRS_Group_Sleep_Apnea_0226 = 0; } 
if (isset($_REQUEST['PQRS_Group_Sleep_Apnea_0276'])) { $PQRS_Group_Sleep_Apnea_0276 = 1; } else { $PQRS_Group_Sleep_Apnea_0276 = 0; }
if (isset($_REQUEST['PQRS_Group_Sleep_Apnea_0277'])) { $PQRS_Group_Sleep_Apnea_0277 = 1; } else { $PQRS_Group_Sleep_Apnea_0277 = 0; }
if (isset($_REQUEST['PQRS_Group_Sleep_Apnea_0278'])) { $PQRS_Group_Sleep_Apnea_0278 = 1; } else { $PQRS_Group_Sleep_Apnea_0278 = 0; }
if (isset($_REQUEST['PQRS_Group_Sleep_Apnea_0279'])) { $PQRS_Group_Sleep_Apnea_0279 = 1; } else { $PQRS_Group_Sleep_Apnea_0279 = 0; }
if (isset($_REQUEST['PQRS_Group_TKR_0130'])) { $PQRS_Group_TKR_0130 = 1; } else { $PQRS_Group_TKR_0130 = 0; }
if (isset($_REQUEST['PQRS_Group_TKR_0226'])) { $PQRS_Group_TKR_0226 = 1; } else { $PQRS_Group_TKR_0226 = 0; }
if (isset($_REQUEST['PQRS_Group_TKR_0350'])) { $PQRS_Group_TKR_0350 = 1; } else { $PQRS_Group_TKR_0350 = 0; }
if (isset($_REQUEST['PQRS_Group_TKR_0351'])) { $PQRS_Group_TKR_0351 = 1; } else { $PQRS_Group_TKR_0351 = 0; } 
if (isset($_REQUEST['PQRS_Group_TKR_0352'])) { $PQRS_Group_TKR_0352 = 1; } else { $PQRS_Group_TKR_0352 = 0; }
if (isset($_REQUEST['PQRS_Group_TKR_0353'])) { $PQRS_Group_TKR_0353 = 1; } else { $PQRS_Group_TKR_0353 = 0; }

sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0001."' WHERE `id` = 'PQRS_0001'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0005."' WHERE `id` = 'PQRS_0005'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0006."' WHERE `id` = 'PQRS_0006'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0007."' WHERE `id` = 'PQRS_0007'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0008."' WHERE `id` = 'PQRS_0008'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0012."' WHERE `id` = 'PQRS_0012'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0014."' WHERE `id` = 'PQRS_0014'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0019."' WHERE `id` = 'PQRS_0019'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0021."' WHERE `id` = 'PQRS_0021'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0022."' WHERE `id` = 'PQRS_0022'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0023."' WHERE `id` = 'PQRS_0023'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0024."' WHERE `id` = 'PQRS_0024'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0032."' WHERE `id` = 'PQRS_0032'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0033."' WHERE `id` = 'PQRS_0033'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0039."' WHERE `id` = 'PQRS_0039'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0040."' WHERE `id` = 'PQRS_0040'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0041."' WHERE `id` = 'PQRS_0041'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0043."' WHERE `id` = 'PQRS_0043'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0044."' WHERE `id` = 'PQRS_0044'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0046."' WHERE `id` = 'PQRS_0046'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0047."' WHERE `id` = 'PQRS_0047'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0048."' WHERE `id` = 'PQRS_0048'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0050."' WHERE `id` = 'PQRS_0050'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0051."' WHERE `id` = 'PQRS_0051'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0052."' WHERE `id` = 'PQRS_0052'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0053."' WHERE `id` = 'PQRS_0053'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0054."' WHERE `id` = 'PQRS_0054'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0065."' WHERE `id` = 'PQRS_0065'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0066."' WHERE `id` = 'PQRS_0066'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0067."' WHERE `id` = 'PQRS_0067'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0068."' WHERE `id` = 'PQRS_0068'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0069."' WHERE `id` = 'PQRS_0069'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0070."' WHERE `id` = 'PQRS_0070'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0071."' WHERE `id` = 'PQRS_0071'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0072."' WHERE `id` = 'PQRS_0072'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0076."' WHERE `id` = 'PQRS_0076'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0081."' WHERE `id` = 'PQRS_0081'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0082."' WHERE `id` = 'PQRS_0082'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0091."' WHERE `id` = 'PQRS_0091'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0093."' WHERE `id` = 'PQRS_0093'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0099."' WHERE `id` = 'PQRS_0099'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0100."' WHERE `id` = 'PQRS_0100'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0102."' WHERE `id` = 'PQRS_0102'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0104."' WHERE `id` = 'PQRS_0104'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0109."' WHERE `id` = 'PQRS_0109'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0110."' WHERE `id` = 'PQRS_0110'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0111."' WHERE `id` = 'PQRS_0111'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0112."' WHERE `id` = 'PQRS_0112'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0113."' WHERE `id` = 'PQRS_0113'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0116."' WHERE `id` = 'PQRS_0116'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0117."' WHERE `id` = 'PQRS_0117'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0118."' WHERE `id` = 'PQRS_0118'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0119."' WHERE `id` = 'PQRS_0119'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0121."' WHERE `id` = 'PQRS_0121'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0122."' WHERE `id` = 'PQRS_0122'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0126."' WHERE `id` = 'PQRS_0126'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0127."' WHERE `id` = 'PQRS_0127'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0128."' WHERE `id` = 'PQRS_0128'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0130."' WHERE `id` = 'PQRS_0130'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0131."' WHERE `id` = 'PQRS_0131'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0134."' WHERE `id` = 'PQRS_0134'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0137."' WHERE `id` = 'PQRS_0137'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0138."' WHERE `id` = 'PQRS_0138'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0140."' WHERE `id` = 'PQRS_0140'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0141."' WHERE `id` = 'PQRS_0141'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0143."' WHERE `id` = 'PQRS_0143'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0144."' WHERE `id` = 'PQRS_0144'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0145."' WHERE `id` = 'PQRS_0145'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0146."' WHERE `id` = 'PQRS_0146'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0147."' WHERE `id` = 'PQRS_0147'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0154."' WHERE `id` = 'PQRS_0154'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0155."' WHERE `id` = 'PQRS_0155'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0156."' WHERE `id` = 'PQRS_0156'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0163."' WHERE `id` = 'PQRS_0163'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0164."' WHERE `id` = 'PQRS_0164'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0165."' WHERE `id` = 'PQRS_0165'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0166."' WHERE `id` = 'PQRS_0166'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0167."' WHERE `id` = 'PQRS_0167'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0168."' WHERE `id` = 'PQRS_0168'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0172."' WHERE `id` = 'PQRS_0172'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0173."' WHERE `id` = 'PQRS_0173'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0178."' WHERE `id` = 'PQRS_0178'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0181."' WHERE `id` = 'PQRS_0181'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0182."' WHERE `id` = 'PQRS_0182'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0185."' WHERE `id` = 'PQRS_0185'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0187."' WHERE `id` = 'PQRS_0187'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0191."' WHERE `id` = 'PQRS_0191'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0192."' WHERE `id` = 'PQRS_0192'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0193."' WHERE `id` = 'PQRS_0193'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0194."' WHERE `id` = 'PQRS_0194'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0195."' WHERE `id` = 'PQRS_0195'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0204."' WHERE `id` = 'PQRS_0204'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0205."' WHERE `id` = 'PQRS_0205'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0217."' WHERE `id` = 'PQRS_0217'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0218."' WHERE `id` = 'PQRS_0218'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0219."' WHERE `id` = 'PQRS_0219'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0220."' WHERE `id` = 'PQRS_0220'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0221."' WHERE `id` = 'PQRS_0221'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0222."' WHERE `id` = 'PQRS_0222'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0223."' WHERE `id` = 'PQRS_0223'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0224."' WHERE `id` = 'PQRS_0224'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0225."' WHERE `id` = 'PQRS_0225'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0226."' WHERE `id` = 'PQRS_0226'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0236."' WHERE `id` = 'PQRS_0236'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0238."' WHERE `id` = 'PQRS_0238'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0242."' WHERE `id` = 'PQRS_0242'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0243."' WHERE `id` = 'PQRS_0243'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0249."' WHERE `id` = 'PQRS_0249'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0250."' WHERE `id` = 'PQRS_0250'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0251."' WHERE `id` = 'PQRS_0251'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0254."' WHERE `id` = 'PQRS_0254'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0255."' WHERE `id` = 'PQRS_0255'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0257."' WHERE `id` = 'PQRS_0257'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0258."' WHERE `id` = 'PQRS_0258'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0259."' WHERE `id` = 'PQRS_0259'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0260."' WHERE `id` = 'PQRS_0260'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0261."' WHERE `id` = 'PQRS_0261'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0262."' WHERE `id` = 'PQRS_0262'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0263."' WHERE `id` = 'PQRS_0263'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0264."' WHERE `id` = 'PQRS_0264'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0265."' WHERE `id` = 'PQRS_0265'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0268."' WHERE `id` = 'PQRS_0268'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0270."' WHERE `id` = 'PQRS_0270'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0271."' WHERE `id` = 'PQRS_0271'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0274."' WHERE `id` = 'PQRS_0274'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0275."' WHERE `id` = 'PQRS_0275'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0303."' WHERE `id` = 'PQRS_0303'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0304."' WHERE `id` = 'PQRS_0304'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0317."' WHERE `id` = 'PQRS_0317'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0320."' WHERE `id` = 'PQRS_0320'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0322."' WHERE `id` = 'PQRS_0322'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0323."' WHERE `id` = 'PQRS_0323'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0324."' WHERE `id` = 'PQRS_0324'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0325."' WHERE `id` = 'PQRS_0325'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0326."' WHERE `id` = 'PQRS_0326'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0327."' WHERE `id` = 'PQRS_0327'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0328."' WHERE `id` = 'PQRS_0328'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0329."' WHERE `id` = 'PQRS_0329'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0330."' WHERE `id` = 'PQRS_0330'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0331."' WHERE `id` = 'PQRS_0331'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0332."' WHERE `id` = 'PQRS_0332'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0333."' WHERE `id` = 'PQRS_0333'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0334."' WHERE `id` = 'PQRS_0334'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0335."' WHERE `id` = 'PQRS_0335'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0336."' WHERE `id` = 'PQRS_0336'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0337."' WHERE `id` = 'PQRS_0337'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0342."' WHERE `id` = 'PQRS_0342'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0343."' WHERE `id` = 'PQRS_0343'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0344."' WHERE `id` = 'PQRS_0344'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0345."' WHERE `id` = 'PQRS_0345'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0346."' WHERE `id` = 'PQRS_0346'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0347."' WHERE `id` = 'PQRS_0347'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0348."' WHERE `id` = 'PQRS_0348'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0349."' WHERE `id` = 'PQRS_0349'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0358."' WHERE `id` = 'PQRS_0358'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0383."' WHERE `id` = 'PQRS_0383'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0384."' WHERE `id` = 'PQRS_0384'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0385."' WHERE `id` = 'PQRS_0385'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0386."' WHERE `id` = 'PQRS_0386'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0387."' WHERE `id` = 'PQRS_0387'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0388."' WHERE `id` = 'PQRS_0388'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0389."' WHERE `id` = 'PQRS_0389'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0390."' WHERE `id` = 'PQRS_0390'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0391."' WHERE `id` = 'PQRS_0391'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0392."' WHERE `id` = 'PQRS_0392'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0393."' WHERE `id` = 'PQRS_0393'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0394."' WHERE `id` = 'PQRS_0394'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0395."' WHERE `id` = 'PQRS_0395'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0396."' WHERE `id` = 'PQRS_0396'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0397."' WHERE `id` = 'PQRS_0397'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0398."' WHERE `id` = 'PQRS_0398'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0399."' WHERE `id` = 'PQRS_0399'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0400."' WHERE `id` = 'PQRS_0400'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0401."' WHERE `id` = 'PQRS_0401'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_0402."' WHERE `id` = 'PQRS_0402'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_always_met."' WHERE `id` = 'PQRS_always_met'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_AOE_0091."' WHERE `id` = 'PQRS_Group_AOE_0091'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_AOE_0093."' WHERE `id` = 'PQRS_Group_AOE_0093'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_AOE_0130."' WHERE `id` = 'PQRS_Group_AOE_0130'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_AOE_0131."' WHERE `id` = 'PQRS_Group_AOE_0131'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_AOE_0154."' WHERE `id` = 'PQRS_Group_AOE_0154'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_AOE_0155."' WHERE `id` = 'PQRS_Group_AOE_0155'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_AOE_0226."' WHERE `id` = 'PQRS_Group_AOE_0226'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_AOE_0317."' WHERE `id` = 'PQRS_Group_AOE_0317'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_Asthma_0053 ."' WHERE `id` = 'PQRS_Group_Asthma_0053'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_Asthma_0110 ."' WHERE `id` = 'PQRS_Group_Asthma_0110'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_Asthma_0128 ."' WHERE `id` = 'PQRS_Group_Asthma_0128'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_Asthma_0130 ."' WHERE `id` = 'PQRS_Group_Asthma_0130'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_Asthma_0226 ."' WHERE `id` = 'PQRS_Group_Asthma_0226'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_Asthma_0402 ."' WHERE `id` = 'PQRS_Group_Asthma_0402'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_CABG_0043 ."' WHERE `id` = 'PQRS_Group_CABG_0043'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_CABG_0044 ."' WHERE `id` = 'PQRS_Group_CABG_0044'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_CABG_0164 ."' WHERE `id` = 'PQRS_Group_CABG_0164'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_CABG_0165 ."' WHERE `id` = 'PQRS_Group_CABG_0165'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_CABG_0166 ."' WHERE `id` = 'PQRS_Group_CABG_0166'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_CABG_0167 ."' WHERE `id` = 'PQRS_Group_CABG_0167'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_CABG_0168 ."' WHERE `id` = 'PQRS_Group_CABG_0168'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_CAD_0006."' WHERE `id` = 'PQRS_Group_CAD_0006'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_CAD_0007."' WHERE `id` = 'PQRS_Group_CAD_0007'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_CAD_0128."' WHERE `id` = 'PQRS_Group_CAD_0128'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_CAD_0130."' WHERE `id` = 'PQRS_Group_CAD_0130'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_CAD_0226."' WHERE `id` = 'PQRS_Group_CAD_0226'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_CAD_0242."' WHERE `id` = 'PQRS_Group_CAD_0242'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_Cataracts_0130."' WHERE `id` = 'PQRS_Group_Cataracts_0130'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_Cataracts_0191."' WHERE `id` = 'PQRS_Group_Cataracts_0191'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_Cataracts_0192."' WHERE `id` = 'PQRS_Group_Cataracts_0192'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_Cataracts_0226."' WHERE `id` = 'PQRS_Group_Cataracts_0226'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_Cataracts_0303."' WHERE `id` = 'PQRS_Group_Cataracts_0303'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_Cataracts_0304."' WHERE `id` = 'PQRS_Group_Cataracts_0304'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_Cataracts_0388."' WHERE `id` = 'PQRS_Group_Cataracts_0388'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_Cataracts_0389."' WHERE `id` = 'PQRS_Group_Cataracts_0389'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_CKD_0047."' WHERE `id` = 'PQRS_Group_CKD_0047'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_CKD_0110."' WHERE `id` = 'PQRS_Group_CKD_0110'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_CKD_0121."' WHERE `id` = 'PQRS_Group_CKD_0121'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_CKD_0122."' WHERE `id` = 'PQRS_Group_CKD_0122'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_CKD_0130."' WHERE `id` = 'PQRS_Group_CKD_0130'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_CKD_0226."' WHERE `id` = 'PQRS_Group_CKD_0226'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_COPD_0047 ."' WHERE `id` = 'PQRS_Group_COPD_0047'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_COPD_0051 ."' WHERE `id` = 'PQRS_Group_COPD_0051'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_COPD_0052 ."' WHERE `id` = 'PQRS_Group_COPD_0052'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_COPD_0110 ."' WHERE `id` = 'PQRS_Group_COPD_0110'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_COPD_0111 ."' WHERE `id` = 'PQRS_Group_COPD_0111'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_COPD_0130 ."' WHERE `id` = 'PQRS_Group_COPD_0130'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_COPD_0226 ."' WHERE `id` = 'PQRS_Group_COPD_0226'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_Dementia_0047 ."' WHERE `id` = 'PQRS_Group_Dementia_0047'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_Dementia_0280 ."' WHERE `id` = 'PQRS_Group_Dementia_0280'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_Dementia_0281 ."' WHERE `id` = 'PQRS_Group_Dementia_0281'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_Dementia_0282 ."' WHERE `id` = 'PQRS_Group_Dementia_0282'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_Dementia_0283 ."' WHERE `id` = 'PQRS_Group_Dementia_0283'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_Dementia_0284 ."' WHERE `id` = 'PQRS_Group_Dementia_0284'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_Dementia_0285 ."' WHERE `id` = 'PQRS_Group_Dementia_0285'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_Dementia_0286 ."' WHERE `id` = 'PQRS_Group_Dementia_0286'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_Dementia_0287 ."' WHERE `id` = 'PQRS_Group_Dementia_0287'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_Dementia_0288 ."' WHERE `id` = 'PQRS_Group_Dementia_0288'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_Diabetes_0001 ."' WHERE `id` = 'PQRS_Group_Diabetes_0001'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_Diabetes_0110 ."' WHERE `id` = 'PQRS_Group_Diabetes_0110'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_Diabetes_0117 ."' WHERE `id` = 'PQRS_Group_Diabetes_0117'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_Diabetes_0119 ."' WHERE `id` = 'PQRS_Group_Diabetes_0119'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_Diabetes_0163 ."' WHERE `id` = 'PQRS_Group_Diabetes_0163'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_Diabetes_0226 ."' WHERE `id` = 'PQRS_Group_Diabetes_0226'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_General_Surgery_0130."' WHERE `id` = 'PQRS_Group_General_Surgery_0130'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_General_Surgery_0226."' WHERE `id` = 'PQRS_Group_General_Surgery_0226'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_General_Surgery_0354."' WHERE `id` = 'PQRS_Group_General_Surgery_0354'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_General_Surgery_0355."' WHERE `id` = 'PQRS_Group_General_Surgery_0355'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_General_Surgery_0356."' WHERE `id` = 'PQRS_Group_General_Surgery_0356'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_General_Surgery_0357."' WHERE `id` = 'PQRS_Group_General_Surgery_0357'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_General_Surgery_0358."' WHERE `id` = 'PQRS_Group_General_Surgery_0358'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_HepatitisC_0084 ."' WHERE `id` = 'PQRS_Group_HepatitisC_0084'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_HepatitisC_0085 ."' WHERE `id` = 'PQRS_Group_HepatitisC_0085'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_HepatitisC_0087 ."' WHERE `id` = 'PQRS_Group_HepatitisC_0087'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_HepatitisC_0130 ."' WHERE `id` = 'PQRS_Group_HepatitisC_0130'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_HepatitisC_0183 ."' WHERE `id` = 'PQRS_Group_HepatitisC_0183'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_HepatitisC_0226 ."' WHERE `id` = 'PQRS_Group_HepatitisC_0226'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_HepatitisC_0390 ."' WHERE `id` = 'PQRS_Group_HepatitisC_0390'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_HepatitisC_0401 ."' WHERE `id` = 'PQRS_Group_HepatitisC_0401'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_HF_0005 ."' WHERE `id` = 'PQRS_Group_HF_0005'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_HF_0008 ."' WHERE `id` = 'PQRS_Group_HF_0008'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_HF_0047 ."' WHERE `id` = 'PQRS_Group_HF_0047'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_HF_0110 ."' WHERE `id` = 'PQRS_Group_HF_0110'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_HF_0130 ."' WHERE `id` = 'PQRS_Group_HF_0130'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_HF_0226 ."' WHERE `id` = 'PQRS_Group_HF_0226'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_HIVAIDS_0047."' WHERE `id` = 'PQRS_Group_HIVAIDS_0047'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_HIVAIDS_0134."' WHERE `id` = 'PQRS_Group_HIVAIDS_0134'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_HIVAIDS_0160."' WHERE `id` = 'PQRS_Group_HIVAIDS_0160'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_HIVAIDS_0205."' WHERE `id` = 'PQRS_Group_HIVAIDS_0205'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_HIVAIDS_0226."' WHERE `id` = 'PQRS_Group_HIVAIDS_0226'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_HIVAIDS_0338."' WHERE `id` = 'PQRS_Group_HIVAIDS_0338'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_HIVAIDS_0339."' WHERE `id` = 'PQRS_Group_HIVAIDS_0339'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_HIVAIDS_0340."' WHERE `id` = 'PQRS_Group_HIVAIDS_0340'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_IBD_0110."' WHERE `id` = 'PQRS_Group_IBD_0110'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_IBD_0111."' WHERE `id` = 'PQRS_Group_IBD_0111'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_IBD_0226."' WHERE `id` = 'PQRS_Group_IBD_0226'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_IBD_0270."' WHERE `id` = 'PQRS_Group_IBD_0270'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_IBD_0271."' WHERE `id` = 'PQRS_Group_IBD_0271'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_IBD_0274."' WHERE `id` = 'PQRS_Group_IBD_0274'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_IBD_0275."' WHERE `id` = 'PQRS_Group_IBD_0275'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_Oncology_0071 ."' WHERE `id` = 'PQRS_Group_Oncology_0071'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_Oncology_0072 ."' WHERE `id` = 'PQRS_Group_Oncology_0072'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_Oncology_0110 ."' WHERE `id` = 'PQRS_Group_Oncology_0110'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_Oncology_0130 ."' WHERE `id` = 'PQRS_Group_Oncology_0130'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_Oncology_0143 ."' WHERE `id` = 'PQRS_Group_Oncology_0143'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_Oncology_0144 ."' WHERE `id` = 'PQRS_Group_Oncology_0144'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_Oncology_0226 ."' WHERE `id` = 'PQRS_Group_Oncology_0226'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_OPEIR_0359."' WHERE `id` = 'PQRS_Group_OPEIR_0359'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_OPEIR_0360."' WHERE `id` = 'PQRS_Group_OPEIR_0360'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_OPEIR_0361."' WHERE `id` = 'PQRS_Group_OPEIR_0361'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_OPEIR_0362."' WHERE `id` = 'PQRS_Group_OPEIR_0362'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_OPEIR_0363."' WHERE `id` = 'PQRS_Group_OPEIR_0363'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_OPEIR_0364."' WHERE `id` = 'PQRS_Group_OPEIR_0364'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_Parkinsons_0047 ."' WHERE `id` = 'PQRS_Group_Parkinsons_0047'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_Parkinsons_0289 ."' WHERE `id` = 'PQRS_Group_Parkinsons_0289'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_Parkinsons_0290 ."' WHERE `id` = 'PQRS_Group_Parkinsons_0290'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_Parkinsons_0291 ."' WHERE `id` = 'PQRS_Group_Parkinsons_0291'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_Parkinsons_0292 ."' WHERE `id` = 'PQRS_Group_Parkinsons_0292'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_Parkinsons_0293 ."' WHERE `id` = 'PQRS_Group_Parkinsons_0293'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_Parkinsons_0294 ."' WHERE `id` = 'PQRS_Group_Parkinsons_0294'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_Preventive_0039 ."' WHERE `id` = 'PQRS_Group_Preventive_0039'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_Preventive_0048 ."' WHERE `id` = 'PQRS_Group_Preventive_0048'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_Preventive_0110 ."' WHERE `id` = 'PQRS_Group_Preventive_0110'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_Preventive_0111 ."' WHERE `id` = 'PQRS_Group_Preventive_0111'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_Preventive_0112 ."' WHERE `id` = 'PQRS_Group_Preventive_0112'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_Preventive_0113 ."' WHERE `id` = 'PQRS_Group_Preventive_0113'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_Preventive_0128 ."' WHERE `id` = 'PQRS_Group_Preventive_0128'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_Preventive_0134 ."' WHERE `id` = 'PQRS_Group_Preventive_0134'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_Preventive_0226 ."' WHERE `id` = 'PQRS_Group_Preventive_0226'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_RA_0108 ."' WHERE `id` = 'PQRS_Group_RA_0108'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_RA_0128 ."' WHERE `id` = 'PQRS_Group_RA_0128'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_RA_0131 ."' WHERE `id` = 'PQRS_Group_RA_0131'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_RA_0176 ."' WHERE `id` = 'PQRS_Group_RA_0176'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_RA_0177 ."' WHERE `id` = 'PQRS_Group_RA_0177'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_RA_0178 ."' WHERE `id` = 'PQRS_Group_RA_0178'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_RA_0179 ."' WHERE `id` = 'PQRS_Group_RA_0179'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_RA_0180 ."' WHERE `id` = 'PQRS_Group_RA_0180'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_Sinusitis_0130."' WHERE `id` = 'PQRS_Group_Sinusitis_0130'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_Sinusitis_0131."' WHERE `id` = 'PQRS_Group_Sinusitis_0131'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_Sinusitis_0226."' WHERE `id` = 'PQRS_Group_Sinusitis_0226'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_Sinusitis_0331."' WHERE `id` = 'PQRS_Group_Sinusitis_0331'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_Sinusitis_0332."' WHERE `id` = 'PQRS_Group_Sinusitis_0332'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_Sinusitis_0333."' WHERE `id` = 'PQRS_Group_Sinusitis_0333'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_Sleep_Apnea_0128."' WHERE `id` = 'PQRS_Group_Sleep_Apnea_0128'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_Sleep_Apnea_0130."' WHERE `id` = 'PQRS_Group_Sleep_Apnea_0130'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_Sleep_Apnea_0226."' WHERE `id` = 'PQRS_Group_Sleep_Apnea_0226'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_Sleep_Apnea_0276."' WHERE `id` = 'PQRS_Group_Sleep_Apnea_0276'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_Sleep_Apnea_0277."' WHERE `id` = 'PQRS_Group_Sleep_Apnea_0277'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_Sleep_Apnea_0278."' WHERE `id` = 'PQRS_Group_Sleep_Apnea_0278'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_Sleep_Apnea_0279."' WHERE `id` = 'PQRS_Group_Sleep_Apnea_0279'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_TKR_0130."' WHERE `id` = 'PQRS_Group_TKR_0130'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_TKR_0226."' WHERE `id` = 'PQRS_Group_TKR_0226'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_TKR_0350."' WHERE `id` = 'PQRS_Group_TKR_0350'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_TKR_0351."' WHERE `id` = 'PQRS_Group_TKR_0351'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_TKR_0352."' WHERE `id` = 'PQRS_Group_TKR_0352'");
sqlStatementNoLog("UPDATE `clinical_rules` SET `active` = '".$PQRS_Group_TKR_0353."' WHERE `id` = 'PQRS_Group_TKR_0353'");
?>
