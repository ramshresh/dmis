--
-- TOC entry 3745 (class 0 OID 239974)
-- Dependencies: 199
-- Data for Name: item; Type: TABLE DATA; Schema: reporting; Owner: postgres
--
/*
COPY "item" ("id", "name", "tags", "meta_hstore", "meta_json", "displayname") FROM stdin;
1	Emergency Situation	\N	\N	\N	\N
2	Earthquake	\N	\N	\N	\N
3	Fire	\N	\N	\N	\N
4	Building Damage	\N	\N	\N	\N
5	Infrastructure Damage	\N	\N	\N	\N
6	Public Utilities Damage	\N	\N	\N	\N
7	Death	\N	\N	\N	\N
9	Missing	\N	\N	\N	\N
11	Property Loss	\N	\N	\N	\N
13	Water	\N	\N	\N	\N
14	Food	\N	\N	\N	\N
15	Medicine	\N	\N	\N	\N
16	Cloth	\N	\N	\N	\N
17	Rescue Vehicle	\N	\N	\N	\N
18	Human Resource	\N	\N	\N	\N
19	Shelter	\N	\N	\N	\N
10	Displaced	\N	\N	\N	\N
21	Fuel	\N	\N	\N	\N
22	Event	\N	\N	\N	\N
23	Need	\N	\N	\N	\N
25	Incident	\N	\N	\N	\N
8	Injury	\N	\N	\N	\N
12	Stranded	\N	\N	\N	\N
20	Disconnected From Service	\N	\N	\N	\N
24	Damage	\N	\N	\N	\N
\.
*/





--
-- TOC entry 3746 (class 0 OID 239980)
-- Dependencies: 200
-- Data for Name: item_child; Type: TABLE DATA; Schema: reporting; Owner: postgres
--
/*
COPY "item_child" ("id", "parent_name", "child_name", "parent_type", "child_type") FROM stdin;
1	Emergency Situation	Event	0	1
2	Emergency Situation	Incident	0	2
4	Emergency Situation	Damage	0	3
12	Emergency Situation	Need	0	4
13	Event	Incident	1	2
14	Event	Damage	1	3
15	Event	Need	1	4
16	Incident	Damage	2	3
17	Incident	Need	2	4
18	Damage	Need	3	4
19	Earthquake	Fire	1	2
20	Earthquake	Building Damage	1	2
21	Earthquake	Infrastructure Damage	1	2
24	Earthquake	Public Utilities Damage	1	2
25	Fire	Building Damage	1	2
26	Fire	Infrastructure Damage	1	2
30	Fire	Public Utilities Damage	1	2
31	Fire	Building Damage	2	3
32	Fire	Infrastructure Damage	2	3
33	Fire	Death	2	3
34	Fire	Injury	2	3
35	Fire	Missing	2	3
36	Fire	Displaced	2	3
37	Fire	Property Loss	2	3
38	Fire	Stranded	2	3
39	Building Damage	Infrastructure Damage	1	2
40	Building Damage	Public Utilities Damage	1	2
41	Building Damage	Infrastructure Damage	2	3
42	Building Damage	Public Utilities Damage	2	3
43	Building Damage	Death	2	3
44	Building Damage	Injury	2	3
46	Building Damage	Missing	2	3
47	Building Damage	Displaced	2	3
48	Building Damage	Property Loss	2	3
49	Building Damage	Stranded	2	3
50	Infrastructure Damage	Building Damage	1	2
52	Infrastructure Damage	Public Utilities Damage	1	2
53	Infrastructure Damage	Building Damage	2	3
54	Infrastructure Damage	Public Utilities Damage	2	3
55	Infrastructure Damage	Disconnected From Service	2	3
56	Infrastructure Damage	Death	2	3
57	Infrastructure Damage	Injury	2	3
58	Infrastructure Damage	Missing	2	3
59	Infrastructure Damage	Displaced	2	3
60	Infrastructure Damage	Property Loss	2	3
61	Infrastructure Damage	Stranded	2	3
63	Public Utilities Damage	Injury	2	3
64	Public Utilities Damage	Missing	2	3
65	Public Utilities Damage	Displaced	2	3
66	Public Utilities Damage	Property Loss	2	3
67	Public Utilities Damage	Stranded	2	3
62	Public Utilities Damage	Disconnected From Service	2	3
69	Public Utilities Damage	Death	2	3
\.
*/


--
-- TOC entry 3749 (class 0 OID 239988)
-- Dependencies: 203
-- Data for Name: item_subtype; Type: TABLE DATA; Schema: reporting; Owner: postgres
--
/*
COPY "item_subtype" ("id", "item_name", "name", "description") FROM stdin;
1	Emergency Situation	Regional	\N
2	Emergency Situation	National	\N
3	Emergency Situation	Local	\N
4	Earthquake	Great	\N
5	Earthquake	Major	\N
6	Earthquake	Strong	\N
7	Earthquake	Moderate	\N
8	Earthquake	Light	\N
9	Earthquake	Minor	\N
10	Fire	Forest Fire	\N
11	Fire	Residential Fire	\N
12	Fire	Industrial Fire	\N
13	Building Damage	Residential Partial	\N
14	Building Damage	Residential Complete	\N
15	Building Damage	Public Partial	\N
16	Building Damage	Public Complete	\N
17	Building Damage	Industrial Partial	\N
18	Building Damage	Industrial Complete	\N
19	Building Damage	School Partial	\N
24	Building Damage	School Complete	\N
25	Infrastructure Damage	Bridge	\N
26	Infrastructure Damage	Overpass Bridge	\N
27	Infrastructure Damage	Road	\N
28	Infrastructure Damage	Power Plant	\N
29	Infrastructure Damage	Railway Line	\N
30	Infrastructure Damage	Transmission Line	\N
31	Public Utilities Damage	Electricity	\N
32	Public Utilities Damage	Water	\N
33	Public Utilities Damage	Sewage	\N
34	Public Utilities Damage	Fuel	\N
35	Public Utilities Damage	Tele-Communication	\N
36	Death	On Spot	\N
38	Death	On First Aid Treatment	\N
37	Death	On Way To Hospital	\N
39	Death	On Recovery	\N
42	Injury	Head Major	\N
41	Injury	Head Minor	\N
43	Injury	Body Major	\N
44	Injury	Body Minor	\N
46	Injury	Limbs Major	\N
47	Injury	Limbs Minor	\N
48	Property Loss	Crop	\N
49	Property Loss	Agricultural Land	\N
50	Property Loss	Building	\N
51	Property Loss	Cash	\N
52	Property Loss	Valuable Metal	\N
53	Property Loss	Livestocks	\N
55	Water	Drinking Purpose	\N
56	Water	General Purpose	\N
57	Medicine	First Aid Kit	\N
59	Rescue Vehicle	Ambulance	\N
60	Rescue Vehicle	Helicopter	\N
61	Rescue Vehicle	Fire Extinguisher	\N
62	Human Resource	General Medical	\N
63	Human Resource	Rescue Volunteer	\N
64	Shelter	Tent	\N
69	Fuel	Kerosene	\N
72	Fuel	LPG Gas	\N
73	Fuel	Petrol	\N
75	Fuel	Disel	\N
76	Need	Immediate	\N
77	Need	Longterm	\N
\.
*/


--
-- TOC entry 3753 (class 0 OID 239999)
-- Dependencies: 207
-- Data for Name: item_type; Type: TABLE DATA; Schema: reporting; Owner: postgres
--
/*
COPY "item_type" ("id", "item_name", "type", "description") FROM stdin;
6	Earthquake	1	Earthquake Event
7	Fire	1	Fire Event
8	Fire	2	Fire Incident
9	Building Damage	1	Building Damage Event
10	Building Damage	2	Building Damage Incident
15	Building Damage	3	Building Damage Impact
16	Infrastructure Damage	1	Infrastructure Damage Event
17	Infrastructure Damage	2	Infrastructure Damage Incident
18	Infrastructure Damage	3	Infrastructure Damage Impact
19	Public Utilities Damage	2	Public Utilities Damage Incident
20	Public Utilities Damage	3	Public Utilities Damage Impact
21	Death	3	Death Impact
22	Injury	3	Injury Impact
23	Missing	3	Missing Impact
24	Displaced	3	Displaced Impact
25	Property Loss	3	Property Loss Impact
26	Stranded	3	Stranded Incident
27	Water	4	Water Need
28	Food	4	Food Need
29	Medicine	4	Medicine Need
30	Cloth	4	Cloth Need
31	Rescue Vehicle	4	Rescue Vehicle Need
32	Human Resource	4	Human Resource  Need
33	Shelter	4	Shelter Need
34	Disconnected From Service	3	Disconnected From Service Impact
35	Fuel	4	Fuel Need
3	Incident	2	Incident that is caused by an Event and induces Damage
2	Event	1	Events that results in multiple Incidents
1	Emergency Situation	0	An Emergency-Situation which is caused by a Primary-Event and may result in a number of Secondary-Events and cause Damages with destructive Incidents
4	Damage	3	Damage or Impact caused by  Incident and can be quantified in terms of monetary-value, number-of-people, number-of-objects etc
5	Need	4	Need can be stated in terms of items and can be quantified
\.
*/


--
-- TOC entry 3769 (class 0 OID 240056)
-- Dependencies: 223
-- Data for Name: units; Type: TABLE DATA; Schema: reporting; Owner: postgres
--
/*
COPY "units" ("id", "standard", "category", "shortname", "displayname", "timestamp_created", "timestamp_updated", "is_verified", "tags", "meta_hstore", "meta_json") FROM stdin;
1	SI	length	m	meter	\N	\N	f	\N	\N	\N
2	SI	area	sq m	square meter	\N	\N	f	\N	\N	\N
3	SI	liquid	l	liter	\N	\N	f	\N	\N	\N
4	SI	weight	kg	kilogram	\N	\N	f	\N	\N	\N
5	CUSTOM	count	nos	number	\N	\N	f	\N	\N	\N
6	CUSTOM	count per person	person	number of person	\N	\N	f	\N	\N	\N
\.
*/


--
-- TOC entry 3771 (class 0 OID 240068)
-- Dependencies: 225
-- Data for Name: course; Type: TABLE DATA; Schema: test_tabular_input; Owner: postgres
--
/*
COPY "course" ("id", "title", "code_title", "code_no") FROM stdin;
165	Differential Calculas	MATH	207
166	Introduction To Geomatics Engineering	GEOM	101
174	Analytic Geometry	MATH	308
175	Introduction to Python Programming	COMP	103
\.
*/


--
-- TOC entry 3773 (class 0 OID 240073)
-- Dependencies: 227
-- Data for Name: person; Type: TABLE DATA; Schema: test_tabular_input; Owner: postgres
--
/*
COPY "person" ("date_of_birth", "address", "gender", "citizenship_no", "id", "nationality", "full_name") FROM stdin;
2014-12-12	hjbhj	f	1234567	41	qwedfgh                                                                    	sita
2014-12-12	cc	m	3244345	40	n                                                                          	gopal
2014-12-12	jhgghasdfgh	m	1234569	42	fghg                                                                       	hari
\.
*/

--
-- TOC entry 3774 (class 0 OID 240080)
-- Dependencies: 228
-- Data for Name: person_child; Type: TABLE DATA; Schema: test_tabular_input; Owner: postgres
--
/*
COPY "person_child" ("parentid", "childid", "type") FROM stdin;
40	41	1
40	42	2
\.
*/


--
-- TOC entry 3778 (class 0 OID 240089)
-- Dependencies: 232
-- Data for Name: student; Type: TABLE DATA; Schema: test_tabular_input; Owner: postgres
--
/*
COPY "student" ("id", "registration_no", "personid") FROM stdin;
44	ggggggg	42
45	gggggg8	41
46	gggggg0	40
\.
*/



--
-- TOC entry 3784 (class 0 OID 240104)
-- Dependencies: 238
-- Data for Name: profile; Type: TABLE DATA; Schema: user; Owner: postgres
--
/*
COPY "profile" ("id", "user_id", "create_time", "update_time", "full_name") FROM stdin;
1	2	2015-01-25 08:39:35	\N	\N
2	3	2015-01-27 16:37:14	\N	\N
\.
*/

--
-- TOC entry 3786 (class 0 OID 240112)
-- Dependencies: 240
-- Data for Name: role; Type: TABLE DATA; Schema: user; Owner: postgres
--
/*
COPY "role" ("id", "name", "create_time", "update_time", "can_admin") FROM stdin;
1	Admin	\N	\N	1
2	User	\N	\N	0
\.
*/



--
-- TOC entry 3788 (class 0 OID 240120)
-- Dependencies: 242
-- Data for Name: user; Type: TABLE DATA; Schema: user; Owner: postgres
--
/*
COPY "user" ("id", "role_id", "status", "email", "new_email", "username", "password", "auth_key", "api_key", "login_ip", "login_time", "create_ip", "create_time", "update_time", "ban_time", "ban_reason") FROM stdin;
2	2	1	ram_shresh@hotmail.com	\N	\N	$2y$13$KyzpRNfoxnQM.3vbxsbj7.M7cVNsnw8p/7FSaTXKeNRE50Ok2Ie1.	X-tW6jgeJ5h0Iu0gaPyIoozrxiv_zBGA	u11L7tK7iAc11ISKrU6op5UCLvuxgvD0	127.0.0.1	2015-02-01 02:11:55	127.0.0.1	2015-01-25 08:39:35	\N	\N	\N
3	2	1	sendmail4ram@gmail.com	\N	\N	$2y$13$RHQyIwM1hQnSGGeaCmzkbOFYzLH6Aso2NeCXgiZR8DlslAjcHVlju	SeiC9abvAK_5jH2U_nbqzZejrQCDPvWl	zALauhhbdfe_c12mvjo52CTER01pRVRm	127.0.0.1	2015-01-30 23:22:58	127.0.0.1	2015-01-27 16:37:13	2015-01-27 16:43:36	\N	\N
\.
*/



--
-- TOC entry 3792 (class 0 OID 240151)
-- Dependencies: 246
-- Data for Name: user_key; Type: TABLE DATA; Schema: user; Owner: postgres
--
/*
COPY "user_key" ("id", "user_id", "type", "key", "create_time", "consume_time", "expire_time") FROM stdin;
1	2	1	HzJNX_Erjkzks-RE3VfGL_zGoICfVHAB	2015-01-25 08:39:35	2015-01-25 09:11:36	\N
2	3	1	XyRTQ5boWjutfQJ7mHMuEuYhoqcOplbZ	2015-01-27 16:37:14	2015-01-27 16:39:38	\N
3	3	3	_swTxHfjItYFNNp1yv8JU2kBVfklzCfx	2015-01-27 16:42:49	2015-01-27 16:43:36	2015-01-29 16:42:49
\.
*/


--
-- TOC entry 3794 (class 0 OID 240159)
-- Dependencies: 248
-- Data for Name: user; Type: TABLE DATA; Schema: user_management; Owner: postgres
--
/*
COPY "user" ("id", "username", "password_hash", "password_reset_token", "email", "auth_key", "role", "status", "created_at", "updated_at") FROM stdin;
2	demo	$2y$13$KG1o1M6qUxHe2Y5KX3Ba2ONuAvslqQ8ksxNTKwAtWOL030VDuM/ka	\N	ram_shresh@hotmail.com	clGoyZ5aVc3kmGzupUqLv8Dec6lx4YCE	10	10	1421525838	1421525838
\.
*/





