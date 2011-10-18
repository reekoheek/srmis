
/*
select * from detail_spb;
update detail_spb set is_po = 1 where id <9 ; 
update req_pembelian set aktivasi =2 where id in (6,9,11,12);
update mr set last_no = 9 , next_no =10, full_no = 'SPB/2806110009' WHERE TYPE='SPB' ;
update ms_barang set kd_barang = 'kd_barang90' where id=20 ;
update purchase_order set created_user = 'Jalu', updated_user = 'Jalu' ;
update purchase_orderdetail set created_user = 'Jalu', updated_user = 'Jalu'; 

*/


select * from req_pembelian where aktivasi =2 ;

select * from mr where type = 'SPB'

select * from ms_barang where flags=2;

select * from head_spb;

select * from detail_spb

select * from purchase_order ;
 
select * from pbf ;

select sum(subtotal), no_po , no_spb, id from purchase_orderdetail  
group By no_po ;

select * from purchase_orderdetail ;

SELECT sum(a.harga_po) as harga, sum(a.amount_discount) as adiscount, 
sum(a.subtotal)as subtotal, a.no_po, a.id 
FROM purchase_orderdetail a
LEFT OUTER JOIN purchase_order b
ON a.no_po  = b.`po_no` 
group by b.po_no, a.`fld01`


SELECT sum(a.harga_po) as harga, sum(a.amount_discount) as adiscount, 
sum(a.subtotal)as subtotal, a.no_po, a.id 
FROM purchase_orderdetail a
group by a.no_po, a.no_spb



/*
SELECT 
a.po_no , a.request_no as po_reqno, (date_format(a.tgl_po, '%d/%m/%Y')) as po_tgl, b.nama as supplier,
(case a.flags when 1 then 'Closed' when 2 then 'Receiving'
when 3 then 'Approved' when 4 then 'Open' when 5 then 'Generated' 
when 6 then 'Canceled' END) as status, 
a.created_user as creator
FROM purchase_order a 
INNER JOIN pbf b ON a.id_supplier = b.id

select * from detail_spb




select
  a.kd_barang as kode, a.nama as nama, b.qty_po as po_qty, b.satuan_po as po_satuan,  
  b.harga_po as po_harga, b.discount as po_discount, b.amount_discount as po_discammount,
  b.subtotal as po_subtotal,b.id as po_detid, b.no_po as po_no, b.no_spb as po_reqno, b.fld01, 
  a.stok as curstok, a.id as id, d.nama as supplier  
from
  ms_barang a
inner join
  purchase_orderdetail b
on
  a.id = b.barang_id
left outer join
  purchase_order c
on
  b.no_po = c.po_no and b.no_spb = c.request_no and b.fld01 = c.id_supplier
inner join 
  pbf d 
on
  b.`fld01` = d.`id` 
group by b.id 


                
select * from purchase_order                
select * from purchase_orderdetail  

select * from ms_barang;
select * from detail_spb;
select * from head_spb; 
*/
