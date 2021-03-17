<?php
# Sentiasa menyediakan garis condong di belakang (/) pada hujung jalan
define('URL', dirname('http://' . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF']) . '/');
define('Tajuk_Muka_Surat', '***');

############################################################################################
## isytihar konsan MYSQL dan GAMBAR ikut lokasi $server
$ip = $_SERVER['REMOTE_ADDR'];
$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
$server = $_SERVER['SERVER_NAME'];

/*
echo "<br>Alamat IP : <font color='red'>" . $ip . "</font> |
\r<br>Nama PC : <font color='red'>" . $hostname . "</font> |
\r<br>Server : <font color='red'>" . $server . "</font>\r";
//*/

if ($server == 'laman.web.anda')
{	# isytihar tatarajah mysql
	define('DB_TYPE', 'mysql');
	define('DB_HOST', 'localhost');
	define('DB_NAME', '***');
	define('DB_USER', '***');
	define('DB_PASS', '***');
}
else
{	# isytihar tatarajah mysql
	define('DB_TYPE', 'mysql');
	define('DB_HOST', 'localhost');
	define('DB_NAME', 'online-hospital-management-system');
	define('DB_USER', 'root');
	define('DB_PASS', '');
}
//echo DB_HOST . "," . DB_USER . "," . DB_PASS . ",," . DB_NAME . "<br>";
############################################################################################
#--------------------------------------------------------------------------------------------------
if ( ! function_exists('semakPembolehubah')):
	/**
	 * semakPembolehubah
	 *
	 * Fungsi ini menyemak pembolehubah yang ada sama ada string atau array
	 *
	 * @param $senarai => string / array
	 * @param $jadual => string
	 * @param $p => int
	 * @return null, cuma echo sahaja
	 */
	function semakPembolehubah($senarai,$jadual='entahlah',$p='0')
	{
		# semak $senarai adalah array atau tidak
		$semak = is_array($senarai) ? 'array' : 'bukan';
		if($semak == 'array'):
			echo '<pre>$' . $jadual . '=><br>';
			if($p == '0') print_r($senarai);
			if($p == '1') var_export($senarai);
			echo '</pre>' . "\n";
		else:
			echo tagVar($senarai,$jadual,2);
		endif;
		//$this->semakPembolehubah($ujian,'ujian',0);
		#http://php.net/manual/en/function.var-export.php
		#http://php.net/manual/en/function.print-r.php
	}
endif;
#--------------------------------------------------------------------------------------------------
if ( ! function_exists('tagVar')):
	function tagVar($senarai,$jadual,$pilih=2)
	{
		# set pembolehubah utama
		$p1 = 'pre';#https://www.w3schools.com/tags/tag_var.asp
		$p2 = 'kbd';
		$p3 = 'code';
		$p4 = 'samp';
		# setkan tatasusunan
		$p[1] = "<$p1>\$$jadual = $senarai</$p1><br>\n";
		$p[2] = "<$p2>\$$jadual = $senarai</$p2><br>\n";
		$p[3] = "<$p3>\$$jadual = $senarai</$p3><br>\n";
		$p[4] = "<$p4>\$$jadual = $senarai</$p4><br>\n";
		#
		return $p[$pilih];
	}
endif;
#--------------------------------------------------------------------------------------------------
if ( ! function_exists('huruf')):
	/**
	 * huruf
	 *
	 * Fungsi ini tukar huruf sama ada besar atau kecil atau sebagainya
	 *
	 * @param $jenis => string
	 * @param $papar => string
	 * @return $papar => string
	 */
	function huruf($jenis, $papar)
	{
		switch($jenis)
		{# mula - pilih $jenis
			case 'BESAR':
				$papar = strtoupper($papar); # huruf('BESAR', )
				break;
			case 'kecil':
				$papar = strtolower($papar); # huruf('kecil', )
				break;
			case 'Depan':
				$papar = ucfirst($papar); # huruf('Depan', )
				break;
			case 'Besar_Depan':
				$papar = mb_convert_case($papar, MB_CASE_TITLE); # huruf('Besar_Depan', )
				break;
		}# tamat - pilih $jenis

		return $papar;
	}
endif;
#--------------------------------------------------------------------------------------------------
if ( ! function_exists('bersih')):
	/** */
	function bersih($papar)
	{
		# lepas lari aksara khas dalam SQL
		//$papar = mysql_real_escape_string($papar);
		# buang ruang kosong (atau aksara lain) dari mula & akhir
		$papar = trim($papar);

		return $papar;
	}
endif;
#--------------------------------------------------------------------------------------------------
if ( ! function_exists('binaJadual')):
	function binaJadual($row, $myTable, $class)
	{
		$output  = null;
		$output .= "\n\t" . '<table ' . $class . '>';
		#-----------------------------------------------------------------
		$printed_headers = false;# mula bina jadual
		#-----------------------------------------------------------------
		for ($kira=0; $kira < count($row); $kira++)
		{	# print the headers once:
			if ( !$printed_headers )
			{##===========================================================
				$output .= "\n\t<thead><tr>\n\t<th>#</th>";
				foreach ( array_keys($row[$kira]) as $tajuk ) :
				$output .= "\n\t" . '<th>' . $tajuk . '</th>';
				endforeach;
				$output .= "\n\t" . '</tr></thead>';
			##============================================================
				$printed_headers = true;
			}
		#-----------------------------------------------------------------
			# print the data row
			//$output .= "\n\t<tbody>";
			$output .= "<tr>\n\t<td>" . ($kira+1) . '</td>';
			foreach ( $row[$kira] as $key=>$data ) :
			$output .= "\n\t" . '<td>' . $data . '</td>';
			endforeach;
			$output .= "\n\t" . '</tr>';
			//$output .= "\n\t" . '</tbody>';
		}#----------------------------------------------------------------
		$output .= "\n\t" . '</table>';

		return $output;
	}
endif;
#--------------------------------------------------------------------------------------------------
//if ( ! function_exists('xxx')):
//endif;
#--------------------------------------------------------------------------------------------------