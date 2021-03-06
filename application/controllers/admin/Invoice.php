<?php 

class Invoice extends CI_Controller{

	public function __construct()
	{
		parent::__construct();

		if($this->session->userdata('role_id') != '1')
		{
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-danger alert-dismissible fade show" role="alert">
				  Anda Belum Login!!! 
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					  	<span aria-hidden="true">&times;</span>
					  </button>
				</div>');
			redirect('auth/login');
		}
	}
	
	public function index()
	{
		$data['invoice'] = $this->model_invoice->tampil_data();
		// $data ['invoice']	= $this->db->query("SELECT * FROM tb_invoice")->result();
		$this->load->view('templates_admin/header');
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/invoice', $data);
		$this->load->view('templates_admin/footer');
	}

	public function detail($id_invoice)
	{
		$data ['invoice'] = $this->model_invoice->ambil_id_invoice($id_invoice);
		$data ['pesanan'] = $this->model_invoice->ambil_id_pesanan($id_invoice);
		// $data['invoice']	= $this->db->query("SELECT * FROM tb_invoice")->result();
		// $data ['pesanan']	= $this->db->query("SELECT * FROM tb_pesanan p, tb_invoice i, tb_barang b, tb_pembayaran pb WHERE p.id_invoice=i.id_invoice AND p.id_brg=b.id_brg")->result();

		$this->load->view('templates_admin/header');
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/detail_invoice', $data);
		$this->load->view('templates_admin/footer');
	}
}