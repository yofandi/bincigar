<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_model extends CI_Model {

	public function make_invoice()
	{
		$bam = [
			'q'	=> ['I' => '01','II' => '02','III' => '03','IV' => '04','V' => '05','VI' => '06','VII' => '07','VIII' => '08','IX' => '09','X' => '10','XI' => '11','XII' => '12'],
			'w' => ['01' => 'I','02' => 'II','03' => 'III','04' => 'IV','05' => 'V','06' => 'VI','07' => 'VII','08' => 'VIII','09' => 'IX','10' => 'X','11' => 'XI','12' => 'XII']
		];
		$hebn = $this->db->select('no_invoice')->order_by('id_penjualan_bagan','desc')->get('penjualan_cerutu');
		if ($hebn->num_rows() > 0) {
			$id = $hebn->row_array();
			$num = substr($id['no_invoice'],0,-12);
			$subnl = substr($num, 2);
			$new_val = (int) $subnl;

			$bulan = substr($id['no_invoice'],8,-5);
			$leng = strlen($bulan);
			$sum = 9 + $leng;
			$tahun = substr($id['no_invoice'],$sum);

			if (date('m') == $bam['q'][$bulan] && date('Y') == $tahun) {
				$kar = $new_val;
				$kar++;
				$jar = str_pad($kar, 3, "0", STR_PAD_LEFT);
			} else {
				$jar = '001';
			}
			$invoice = $jar.'/EXP/'.$bam['w'][date('m')].'/'.date('Y');
		} else {
			$invoice = '001'.'/EXP/'.$bam['w'][date('m')].'/'.date('Y');
		}
		return $invoice;
	}	

}

/* End of file M_model.php */
/* Location: ./application/models/M_model.php */