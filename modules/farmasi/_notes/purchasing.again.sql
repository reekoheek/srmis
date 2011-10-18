select * from barang_unit;


SELECT * FROM barang_unit,ms_barang WHERE barang_unit.barang_id=ms_barang.id AND barang_unit.unit_id='2' AND ms_barang.status = 'Aktif' ;

select * from ms_barang;

select * from daftar_akun order by `type`, `group`, `sub_group`;

select * from jurnal_penyesuaian;
select * from jurnal_umum;
select * from req_pembelian;

select * from daftar_akun where type=3 and `group` like '311%';

select * from ms_barang;
select * from set_harga;
update set_harga set no_batch= '8999009218439' where barang_id=34 and po_no = 'PON/0207110007';

select * from;
select po_no, barang_id, no_batch, supp_id, price_now, price_po, po_date, date_sub(po_date,interval 3 month) as po_t from set_harga
where po_date between date_sub(curdate(), interval 3 month) and curdate() and barang_id =34 group by no_batch order by  price_po desc;

select distinct barang_id, price_po from set_harga
where po_date between date_sub(curdate(), interval 3 month) and curdate() group by (select distinct barang_id from set_harga where barang_id = 34),
(select distinct supp_id from set_harga where barang_id =34)order by price_po desc ;

truncate table purchase_order;
select * from purchase_order;
select * from purchase_orderdetail;
SELECT * from generate_po;
select * from detail_spb;
select * from head_spb;
select * from mr;
update mr set param_no = 1 , last_no =1 , next_no =2, full_no ='PON/1707110001'  where id =2 ;

SELECT COUNT(ID) FROM generate_po where supp_id=1 and request_no='SPB/0207110035';
SELECT id FROM purchase_order WHERE po_no='PON/1707110001' and id_supplier= 1;
update ms_barang set flags = 2 where id = 12 ;

select a.flags, a.id, a.kd_barang, b.aktivasi, b.id, b.kd_barang
from ms_barang a inner join req_pembelian b on a.kd_barang= b.kd_barang ;
where a.flags = 2 ;
select * from req_pembelian;
SELECT distinct * FROM ms_barang,req_pembelian
WHERE ms_barang.kd_barang = req_pembelian.kd_barang
and req_pembelian.aktivasi=1 and ms_barang.flags = 2 ;

select * from ms_barang where kd_barang in ('01012287', '01010045');

select * from purchase_orderdetail ;
select * from purchase_order;
select * from ms_barang  order by kd_barang;
update purchase_order set flags = 2  where id=1;


SELECT a.group_barang, a.kd_barang, a.nama, a.satuan, a.pabrik01, b.satuan_po, a.jenis_obat,
a.kategori_obat, a.golongan, b.fld05, day(b.fld05), month(b.fld05), year(b.fld05),
a.tipe_obat, b.harga_po, b.discount, (b.harga_po * 0.1), a.stok_max, a.stok_min, b.qty_po, 1,
now(), '$userLoged', now(), '$userLoged', b.no_po,  b.no_spb, b.id
FROM ms_barang a INNER JOIN purchase_orderdetail b on a.id = b.barang_id ;where b.id =$val