-- Procedure: pendaftaran_get_pasien

DROP PROCEDURE IF EXISTS `pendaftaran_get_pasien`;

DELIMITER |

CREATE PROCEDURE `pendaftaran_get_pasien` 
(
  IN `pas_id` int
)
BEGIN
   SELECT p.*, kec.id as kec_id, kab.id as kab_id, prop.id as prop_id
   FROM pasien p JOIN ref_desa des ON (des.id = p.desa_id) JOIN ref_kecamatan kec ON (kec.id = des.kecamatan_id) JOIN ref_kabupaten kab ON (kab.id = kec.kabupaten_id) JOIN ref_propinsi prop ON (prop.id = kab.propinsi_id)
   WHERE p.id = pas_id;
END|

DELIMITER ;


-- Procedure: get_desa

DROP PROCEDURE IF EXISTS `get_desa`;

DELIMITER |

CREATE PROCEDURE `get_desa` 
(
  IN `kec_id` int
)
BEGIN
  SELECT id,nama
  FROM ref_desa
  WHERE kecamatan_id = kec_id
  ORDER BY nama;
END|

DELIMITER ;


-- Procedure: get_kabupaten

DROP PROCEDURE IF EXISTS `get_kabupaten`;

DELIMITER |

CREATE PROCEDURE `get_kabupaten` 
(
  IN `prop_id` int
)
BEGIN
  SELECT id,nama
  FROM ref_kabupaten
  WHERE propinsi_id = prop_id
  ORDER BY nama;
END|

DELIMITER ;


-- Procedure: get_kecamatan

DROP PROCEDURE IF EXISTS `get_kecamatan`;

DELIMITER |

CREATE PROCEDURE `get_kecamatan` 
(
  IN `kab_id` int
)
BEGIN
  SELECT id,nama
  FROM ref_kecamatan
  WHERE kabupaten_id=kab_id
  ORDER BY nama;
END|

DELIMITER ;
