DELETE FROM list_options WHERE list_id = 'ptlistcols';

INSERT INTO list_options ( list_id, option_id, title, seq, option_value, mapping, notes ) VALUES 
('ptlistcols', 'providerID', 'Provider ID', '30', '', '0', ''),
('ptlistcols','name'      ,'Full Name'     ,'10','3','',''),
('ptlistcols','phone_home','Home Phone'    ,'20','3','',''),
('ptlistcols','DOB'       ,'Date of Birth' ,'40','3','',''),
('ptlistcols','pid'    ,'Patient ID'   ,'50','3','','');