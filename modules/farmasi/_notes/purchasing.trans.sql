/*
select
a.id, a.po_no, a.tgl_po, a.grand_total, a.created_user as createBy,
a.flags as status, a.usr_cancel as canceledBy
from PURCHASE_ORDER a inner join PURCHASE_ORDERDETAIL b
on a.po_no = b.no_po;

select distinct
a.id, a.po_no, a.tgl_po, a.grand_total, a.created_user as createBy,
a.flags as status, a.usr_cancel as canceledBy
from PURCHASE_ORDER a ;

select * from purchase_order ;
select * from pbf;

select a.po_no , a.request_no as po_reqno, (date_format(a.tgl_po, '%d/%m/%Y')) as po_tgl, b.nama as supplier,
(case a.flags when 1 then 'Closed' when 2 then 'Receiving'
when 3 then 'Approved' when 4 then 'Open' when 5 then 'Canceled' END) as status
from purchase_order a inner join pbf b on
a.id_supplier = b.id ;
*/

