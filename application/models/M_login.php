<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_login extends CI_Model
{
	private $_table = 'tbl_user';

	public function login($username, $password)
	{
		$where = array(
			'username' => $username,
			'password' => $password
		);
		$cek = $this->db->get_where($this->_table, $where);
		return $cek->num_rows();
	}

	public function get_user($username)
	{
		//$user = $this->db->get_where($this->_table, ['username' => $username])->row_array();
		$user = $this->db->select('*')->from($this->_table . ' a')->join('tbl_pegawai b', 'a.id_pegawai = b.id_pegawai', 'left')->join('tbl_jabatan c', 'b.id_jabatan = c.id_jabatan', 'left')->where('a.username', $username)->get()->row_array();
		return $user;
	}

	public function show()
	{
		$data = $this->db->select('*')->from($this->_table . ' a')->join('tbl_jabatan b', 'a.id_jabatan = b.id_jabatan', 'left')->get()->result_array();
		return $data;
	}

	public function create($data)
	{
		$this->db->insert($this->_table, $data);
	}

	public function read($key)
	{
		$data = $this->db->select('*')->from($this->_table . ' a')->join('tbl_jabatan b', 'a.id_jabatan = b.id_jabatan', 'left')->where($key)->get();
		return $data;
	}

	public function update($data, $key)
	{
		$this->db->update($this->_table, $data, $key);
	}

	public function delete($key)
	{
		$this->db->delete($this->_table, $key);
	}
	
}
