<?php

if( isset( $_GET[ 'kod' ] ) )
  {
    header( 'Content-Type:text/html;charset=UTF-8' );

    die(
      '<style>
        body > code {
                      display: block;
                      font: bold 18px Courier;
                      border: 2px ridge;
                      padding: 20px;
                      margin: 10px auto;
                      background: #ccc;
                    }
       </style>'
     .
      highlight_string( strtr( file_get_contents( $_SERVER[ 'SCRIPT_FILENAME' ] ), array( ''=>'', ""=>'' ) ), true )
     .
      '<button onclick="javascript:history.back()">powrót</button>'
    );
  }