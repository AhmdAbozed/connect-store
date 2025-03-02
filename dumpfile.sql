--
-- PostgreSQL database dump
--

-- Dumped from database version 16.6 (Ubuntu 16.6-0ubuntu0.24.04.1)
-- Dumped by pg_dump version 16.6 (Ubuntu 16.6-0ubuntu0.24.04.1)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: brands; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.brands (
    id bigint NOT NULL,
    name text NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.brands OWNER TO postgres;

--
-- Name: brands_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.brands_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.brands_id_seq OWNER TO postgres;

--
-- Name: brands_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.brands_id_seq OWNED BY public.brands.id;


--
-- Name: cache; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.cache (
    key character varying(255) NOT NULL,
    value text NOT NULL,
    expiration integer NOT NULL
);


ALTER TABLE public.cache OWNER TO postgres;

--
-- Name: cache_locks; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.cache_locks (
    key character varying(255) NOT NULL,
    owner character varying(255) NOT NULL,
    expiration integer NOT NULL
);


ALTER TABLE public.cache_locks OWNER TO postgres;

--
-- Name: categories; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.categories (
    id bigint NOT NULL,
    name text NOT NULL,
    img_id text NOT NULL,
    specifications text,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.categories OWNER TO postgres;

--
-- Name: categories_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.categories_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.categories_id_seq OWNER TO postgres;

--
-- Name: categories_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.categories_id_seq OWNED BY public.categories.id;


--
-- Name: failed_jobs; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.failed_jobs (
    id bigint NOT NULL,
    uuid character varying(255) NOT NULL,
    connection text NOT NULL,
    queue text NOT NULL,
    payload text NOT NULL,
    exception text NOT NULL,
    failed_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);


ALTER TABLE public.failed_jobs OWNER TO postgres;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.failed_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.failed_jobs_id_seq OWNER TO postgres;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.failed_jobs_id_seq OWNED BY public.failed_jobs.id;


--
-- Name: migrations; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);


ALTER TABLE public.migrations OWNER TO postgres;

--
-- Name: migrations_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.migrations_id_seq OWNER TO postgres;

--
-- Name: migrations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;


--
-- Name: orders; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.orders (
    id bigint NOT NULL,
    fullname text NOT NULL,
    address text NOT NULL,
    phone_number bigint NOT NULL,
    products text NOT NULL,
    status text NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    user_id bigint
);


ALTER TABLE public.orders OWNER TO postgres;

--
-- Name: orders_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.orders_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.orders_id_seq OWNER TO postgres;

--
-- Name: orders_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.orders_id_seq OWNED BY public.orders.id;


--
-- Name: otps; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.otps (
    id bigint NOT NULL,
    user_id bigint NOT NULL,
    token character varying(6) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.otps OWNER TO postgres;

--
-- Name: otps_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.otps_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.otps_id_seq OWNER TO postgres;

--
-- Name: otps_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.otps_id_seq OWNED BY public.otps.id;


--
-- Name: password_reset_tokens; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.password_reset_tokens (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);


ALTER TABLE public.password_reset_tokens OWNER TO postgres;

--
-- Name: personal_access_tokens; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.personal_access_tokens (
    id bigint NOT NULL,
    tokenable_type character varying(255) NOT NULL,
    tokenable_id bigint NOT NULL,
    name character varying(255) NOT NULL,
    token character varying(64) NOT NULL,
    abilities text,
    last_used_at timestamp(0) without time zone,
    expires_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.personal_access_tokens OWNER TO postgres;

--
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.personal_access_tokens_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.personal_access_tokens_id_seq OWNER TO postgres;

--
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.personal_access_tokens_id_seq OWNED BY public.personal_access_tokens.id;


--
-- Name: products; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.products (
    id bigint NOT NULL,
    name text NOT NULL,
    price double precision NOT NULL,
    discounted_price double precision,
    stock integer NOT NULL,
    specifications text NOT NULL,
    category_id bigint NOT NULL,
    subcategory_id bigint,
    img_id text NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    type text NOT NULL,
    wholesale double precision
);


ALTER TABLE public.products OWNER TO postgres;

--
-- Name: products_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.products_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.products_id_seq OWNER TO postgres;

--
-- Name: products_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.products_id_seq OWNED BY public.products.id;


--
-- Name: subcategories; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.subcategories (
    id bigint NOT NULL,
    name text NOT NULL,
    img_id text NOT NULL,
    category_id bigint NOT NULL,
    specifications text,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.subcategories OWNER TO postgres;

--
-- Name: subcategories_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.subcategories_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.subcategories_id_seq OWNER TO postgres;

--
-- Name: subcategories_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.subcategories_id_seq OWNED BY public.subcategories.id;


--
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.users (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    email_verified_at timestamp(0) without time zone,
    password character varying(255) NOT NULL,
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    phone_number character varying(20) NOT NULL,
    number_verified_at timestamp(0) without time zone,
    type character varying(10) NOT NULL
);


ALTER TABLE public.users OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.users_id_seq OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- Name: brands id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.brands ALTER COLUMN id SET DEFAULT nextval('public.brands_id_seq'::regclass);


--
-- Name: categories id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.categories ALTER COLUMN id SET DEFAULT nextval('public.categories_id_seq'::regclass);


--
-- Name: failed_jobs id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.failed_jobs ALTER COLUMN id SET DEFAULT nextval('public.failed_jobs_id_seq'::regclass);


--
-- Name: migrations id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);


--
-- Name: orders id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.orders ALTER COLUMN id SET DEFAULT nextval('public.orders_id_seq'::regclass);


--
-- Name: otps id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.otps ALTER COLUMN id SET DEFAULT nextval('public.otps_id_seq'::regclass);


--
-- Name: personal_access_tokens id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.personal_access_tokens ALTER COLUMN id SET DEFAULT nextval('public.personal_access_tokens_id_seq'::regclass);


--
-- Name: products id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.products ALTER COLUMN id SET DEFAULT nextval('public.products_id_seq'::regclass);


--
-- Name: subcategories id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.subcategories ALTER COLUMN id SET DEFAULT nextval('public.subcategories_id_seq'::regclass);


--
-- Name: users id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- Data for Name: brands; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.brands (id, name, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: cache; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.cache (key, value, expiration) FROM stdin;
laravel_cache_d2bfa8e8b749d2772a21edee7b70a2b3:timer	i:1739143520;	1739143520
laravel_cache_d2bfa8e8b749d2772a21edee7b70a2b3	i:6;	1739143520
laravel_cache_a3affa0d1e1a3c72b78aa984c3367a05:timer	i:1739813818;	1739813818
laravel_cache_a3affa0d1e1a3c72b78aa984c3367a05	i:1;	1739813818
laravel_cache_backblaze_auth_token	O:8:"stdClass":2:{s:18:"authorizationToken";s:77:"4_003544fb55ddb2b0000000000_01ba7afc_a63133_acct_7LhLOGXhvVmr3MCfmVgXmw_beQY=";s:6:"apiUrl";s:30:"https://api003.backblazeb2.com";}	1739820988
laravel_cache_a75f3f172bfb296f2e10cbfc6dfc1883:timer	i:1739812908;	1739812908
laravel_cache_a75f3f172bfb296f2e10cbfc6dfc1883	i:1;	1739812908
\.


--
-- Data for Name: cache_locks; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.cache_locks (key, owner, expiration) FROM stdin;
\.


--
-- Data for Name: categories; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.categories (id, name, img_id, specifications, created_at, updated_at) FROM stdin;
3	PC Accessories	8917fbcab8	\N	2024-09-07 03:33:44	2024-09-07 03:37:53
6	Speakers	be6d7ec24d	\N	2024-09-07 03:36:37	2024-09-07 03:39:05
7	PC Components	028766d3bb	\N	2024-09-07 03:41:33	2024-09-07 03:41:33
8	Laptops	a269d04ead	\N	2024-09-07 03:42:34	2024-09-07 04:12:20
9	Networking	e00ad571c6	\N	2024-09-08 12:17:08	2024-09-10 03:20:46
1	Cameras	d7095a3c84	\N	\N	2024-09-10 03:33:20
4	Storage Devices	7578d55e44	\N	2024-09-07 03:34:17	2024-09-16 05:58:47
10	Computer Peripherals	ed0339d1a6	\N	2024-09-22 15:57:08	2024-09-22 15:59:32
12	Printers & Supplies	be37ad08cd	\N	2024-09-27 21:01:33	2024-09-27 21:01:33
\.


--
-- Data for Name: failed_jobs; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.failed_jobs (id, uuid, connection, queue, payload, exception, failed_at) FROM stdin;
\.


--
-- Data for Name: migrations; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.migrations (id, migration, batch) FROM stdin;
61	2014_10_12_000000_create_users_table	1
62	2014_10_12_100000_create_password_reset_tokens_table	1
63	2019_08_19_000000_create_failed_jobs_table	1
64	2019_12_14_000001_create_personal_access_tokens_table	1
65	2024_07_26_350340_create_brands_table	1
66	2024_07_27_212909_create_categories_table	1
67	2024_08_12_170329_create_orders_table	1
68	2024_08_23_161057_create_sub_categories_table	1
69	2024_09_01_212924_create_products_table	1
70	2024_09_02_372103_add_full_text_index_to_products_table	2
71	2024_09_22_050514_create_otps_table	3
72	2024_10_01_223825_add_wholesale	3
73	2025_01_31_183846_create_cache_table	3
74	2025_02_09_183846_user_update	4
75	2025_02_09_190907_order_update	5
\.


--
-- Data for Name: orders; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.orders (id, fullname, address, phone_number, products, status, created_at, updated_at, user_id) FROM stdin;
5	Ahmed	Ismailia	1061676615	[{"id":26,"quantity":1},{"id":25,"quantity":1},{"id":29,"quantity":1}]	complete	2024-09-14 04:20:03	2024-09-14 04:20:40	\N
6	test name	test address	120000000	[{"id":25,"quantity":1},{"id":19,"quantity":1}]	pending	2024-09-15 16:19:50	2024-09-15 16:19:50	\N
9	Ahmed hassan	Ismaillia	1200000000	[{"id":28,"quantity":2},{"id":75,"quantity":1},{"id":50,"quantity":1},{"id":39,"quantity":1},{"id":47,"quantity":1},{"id":22,"quantity":21}]	pending	2025-02-15 22:38:41	2025-02-15 22:38:41	\N
\.


--
-- Data for Name: otps; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.otps (id, user_id, token, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: password_reset_tokens; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.password_reset_tokens (email, token, created_at) FROM stdin;
\.


--
-- Data for Name: personal_access_tokens; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.personal_access_tokens (id, tokenable_type, tokenable_id, name, token, abilities, last_used_at, expires_at, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: products; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.products (id, name, price, discounted_price, stock, specifications, category_id, subcategory_id, img_id, created_at, updated_at, type, wholesale) FROM stdin;
22	Power supply 10A	1111	222	5	[{"specName":"Voltage","specValue":"12V"},{"specName":"Wattage","specValue":"240W"}]	1	3	cb8c2f804a	2024-09-09 17:59:06	2024-09-09 17:59:06	Cameras	\N
29	DS-7604NXI-K1/4P	2000	1009	2	[{"specName":"Type","specValue":"NVR"},{"specName":"Channel Number","specValue":"4-ch"},{"specName":"Brand","specValue":"Hikvision"},{"specName":"Condition","specValue":"New"},{"specName":"Subseries","specValue":"K Series NVR with AcuSense"},{"specName":"HDD Interface","specValue":"1"},{"specName":"Material","specValue":"Metal"},{"specName":"POE Interface","specValue":" 4-ch"},{"specName":"Decoding Capability","specValue":"8-ch@1080p"},{"specName":"AI","specValue":" Yes"}]	1	1	6f118a0741	2024-09-10 19:17:28	2024-09-10 20:09:15	Cameras	\N
25	UAC-T112-F28	300	200	1	[{"specName":"Brand","specValue":"UNV "},{"specName":"Form Factor","specValue":"Dome"},{"specName":"Connectivity Technology","specValue":"Wired"},{"specName":"video resolution","specValue":"1080p"},{"specName":"Camera Types","specValue":"HD"},{"specName":"Lens","specValue":"2.8mm\\t"},{"specName":"Illumination distance","specValue":"Up to 20 m"}]	1	2	6035444854	2024-09-10 06:32:49	2024-09-10 06:32:49	Cameras	\N
26	Power Supply Security LAVA 18CH 20A BOX	200	\N	2	[{"specName":"Output Volts","specValue":"12V DC"},{"specName":"Output Amps","specValue":"20A"},{"specName":"Brand","specValue":"LAVA "},{"specName":"Material","specValue":"Metal"},{"specName":"Waterproof","specValue":"YES"},{"specName":"Power Source","specValue":"External"}]	1	3	a9b64982c6	2024-09-10 15:12:22	2024-09-10 15:12:22	Cameras	\N
27	Power Supply Security 5A	100	\N	1	[{"specName":"Output Volts","specValue":"12V DC"},{"specName":"Output Amps","specValue":"5A"},{"specName":"Brand","specValue":"POINT"},{"specName":"Material","specValue":"Metal"},{"specName":"Waterproof","specValue":"NO"},{"specName":"Mounting Type\\t","specValue":"Wall Mount"},{"specName":"Compatible Devices\\t","specValue":"Cameras"}]	1	3	e5e3d230d4	2024-09-10 15:16:12	2024-09-10 15:16:12	Cameras	\N
19	iDS-7104HUHI-M1/S	3000	2009	4	[{"specName":"Type","specValue":"DVR"},{"specName":"Channel Number","specValue":"4-ch"},{"specName":"Resolution","specValue":"5MP"},{"specName":"Brand","specValue":"Hikvision"},{"specName":"Condition","specValue":"New"},{"specName":"Subseries","specValue":"Value Series With AcuSense"},{"specName":"Video Input","specValue":"4-ch"},{"specName":"Video Compression","specValue":" H.265"},{"specName":"HDD Interface","specValue":"1"},{"specName":"Material","specValue":"Plastic"},{"specName":"Motion Detection 2.0","specValue":" Deep learning-based motion detection 2.0 is enabled by default for all analog channels, it can classify human and vehicle, and extremely reduce false alarms caused by objects like leaves and lights"},{"specName":"Video Input","specValue":"8-ch"},{"specName":"Facial Detection and Capture","specValue":"Face picture detection, face picture search"},{"specName":"Analog Video Input","specValue":"4-ch"},{"specName":"Video Compression","specValue":"H.265 Pro+/H.265 Pro/H.265/H.264+/H.264"}]	1	1	161e985c8c	2024-09-09 17:55:21	2024-09-10 17:03:19	Cameras	\N
28	DS-7608NXI-K1	3000	\N	1	[{"specName":"Type","specValue":"NVR"},{"specName":"Channel Number","specValue":"8-ch"},{"specName":"Resolution","specValue":"5MP"},{"specName":"Brand","specValue":"Hikvision"},{"specName":"Condition","specValue":"New"},{"specName":"Subseries","specValue":"K Series NVR with AcuSense"},{"specName":"Video Compression","specValue":" H.265"},{"specName":"HDD Interface","specValue":"1"},{"specName":"Material","specValue":"Metal"},{"specName":"Decoding Capability","specValue":"8-ch@1080p"},{"specName":"AI","specValue":" Yes"}]	1	1	99516f64e6	2024-09-10 18:45:31	2024-09-10 18:50:10	Cameras	\N
24	DS-2CD1123G0E-I	1000	9	1	[{"specName":"Brand","specValue":"Hikvision"},{"specName":"Form Factor","specValue":"Dome"},{"specName":"Connectivity Technology","specValue":"Wired"},{"specName":"video resolution","specValue":"1080p"},{"specName":"Camera Types","specValue":"IP"},{"specName":"Lens","specValue":"2.8mm\\t"}]	1	2	0f3e4474f0	2024-09-10 06:22:08	2024-09-11 06:25:42	Cameras	\N
30	DS-2CE12DF0T-FS	200	100	2	[{"specName":"Brand","specValue":"Hikvision"},{"specName":"Case Type","specValue":"Bullet"},{"specName":"Connectivity Technology","specValue":"Wired"},{"specName":"Resolution","specValue":"2MP"},{"specName":"Camera Types","specValue":"HD"},{"specName":"Lens","specValue":"2.8mm\\t"},{"specName":"IR Distance","specValue":"21-50m"},{"specName":"WDR","specValue":"DWDR"},{"specName":"Illumination Level","specValue":"ColorVu"},{"specName":"Material","specValue":"Metal"}]	1	2	51faf5f9dd	2024-09-11 06:45:01	2024-09-11 06:45:01	Cameras	\N
31	DS-2CE50DF3T-VPLSE	250	230	2	[{"specName":"Brand","specValue":"Hikvision"},{"specName":"Case Type","specValue":"Dome"},{"specName":"Connectivity Technology","specValue":"Wired"},{"specName":"Resolution","specValue":"2MP"},{"specName":"Camera Types","specValue":"HD"},{"specName":"Lens","specValue":"2.8mm\\t"},{"specName":"IR Distance","specValue":" 21-50m"},{"specName":"WDR","specValue":"True WDR"},{"specName":"Illumination Level","specValue":"ColorVu"},{"specName":"Material","specValue":"Plastic&Metal"}]	1	2	079b94fd7a	2024-09-11 06:50:15	2024-09-11 06:50:15	Cameras	\N
32	DS-2CD1023G0-IUF	260	250	1	[{"specName":"Brand","specValue":"Hikvision"},{"specName":"Case Type","specValue":"Bullet"},{"specName":"Connectivity Technology","specValue":"Wired"},{"specName":"Resolution","specValue":"2MP"},{"specName":"Camera Types","specValue":"IP"},{"specName":"Lens","specValue":"4mm"},{"specName":"IR Distance","specValue":"21-50m"},{"specName":"WDR","specValue":" DWDR"}]	1	2	edf8387004	2024-09-11 07:15:09	2024-09-11 07:15:09	Cameras	\N
33	DS-7108HGHI-K1	2000	1009	2	[{"specName":"Type","specValue":"DVR"},{"specName":"Channel Number","specValue":"8-ch"},{"specName":"Resolution","specValue":" 2MP"},{"specName":"Brand","specValue":"Hikvision"},{"specName":"Condition","specValue":"New"},{"specName":"Subseries","specValue":"Value Series With AcuSense"},{"specName":"Video Input","specValue":"8-ch"},{"specName":"HDD Interface","specValue":"1"},{"specName":"Material","specValue":"Plastic"}]	1	1	2037002255	2024-09-11 14:36:39	2024-09-11 14:36:39	Cameras	\N
34	PFM920I-6UN-CN	2100	\N	1	[{"specName":"Brand","specValue":"Dahua"},{"specName":"Cable Length","specValue":"305m"},{"specName":"Cable Type","specValue":"Ethernet"},{"specName":"Color","specValue":"Grey "},{"specName":"Network Cable","specValue":"Cat6"},{"specName":"Material","specValue":"Oxygen free copper (99.95% purity)"},{"specName":"Diameter","specValue":"0.53 mm ± 0.02mm（0.02\\" ± 0.0007\\")"},{"specName":"American Wire Gauge","specValue":"24AWG"}]	1	4	f23927a754	2024-09-11 19:11:41	2024-09-11 19:11:41	Cameras	\N
35	PFM930-59N-100	1000	\N	1	[{"specName":"Brand","specValue":"Dahua"},{"specName":"Cable Length","specValue":"100m"},{"specName":"Cable Type","specValue":"Coaxial"},{"specName":"Color","specValue":"Black "},{"specName":"CCTV Cable","specValue":"RG59"}]	1	4	0314bd8b07	2024-09-11 19:17:55	2024-09-11 19:17:55	Cameras	\N
36	CCTV Cable LAVA RG59 200M	3000	\N	1	[{"specName":"Brand","specValue":"LAVA "},{"specName":"Cable Length","specValue":"200m"},{"specName":"Cable Type","specValue":"Coaxial"},{"specName":"Color","specValue":"Black"},{"specName":"CCTV Cable","specValue":"RG58"}]	1	4	0fdf21a3d9	2024-09-11 19:30:26	2024-09-11 19:30:26	Cameras	\N
37	BNC Cable 1 Packs-white	10	\N	1	[{"specName":"Brand","specValue":"Generic"},{"specName":"Color","specValue":"White"},{"specName":"Material","specValue":"Plastic"},{"specName":"Connector Type","specValue":"BNC"}]	1	5	18760ce277	2024-09-11 21:12:51	2024-09-11 21:12:51	Cameras	\N
38	BNC Cable 1 Packs -Black	5	\N	1	[{"specName":"Brand","specValue":"Generic"},{"specName":"Color","specValue":"Black"},{"specName":"Connector Type","specValue":"BNC"}]	1	5	05cb645dcf	2024-09-11 21:14:12	2024-09-11 21:14:12	Cameras	\N
39	Camera Mount Bracket 30cm	200	\N	1	[{"specName":"Brand","specValue":"LAVA "},{"specName":"Color","specValue":"White"},{"specName":"Material","specValue":"Metal"},{"specName":"Mounting Type","specValue":"Ceiling Mount"}]	1	5	0a25bac01a	2024-09-12 03:23:11	2024-09-12 03:23:11	Cameras	\N
40	Camera Mount Bracket 60-120cm	250	\N	1	[{"specName":"Brand","specValue":"LAVA "},{"specName":"Color","specValue":"White"},{"specName":"Material","specValue":"Metal"},{"specName":"Mounting Type","specValue":"Ceiling Mount"}]	1	5	0b5913fa44	2024-09-12 03:24:25	2024-09-12 03:24:25	Cameras	\N
41	DC 2.1 Power male Plug with Wire	5	\N	1	[{"specName":"Brand","specValue":"Generic"},{"specName":"Color","specValue":"Black"}]	1	5	acc47abeb7	2024-09-12 03:33:24	2024-09-12 03:33:24	Cameras	\N
42	CCTV Microphone Case	220	\N	1	[{"specName":"Brand","specValue":"Generic"},{"specName":"Color","specValue":"White"},{"specName":"Material","specValue":"Plastic"},{"specName":"Connector type","specValue":"3.5mm audio jack"},{"specName":"Power source","specValue":"\\t Corded Electric"}]	1	5	802c18b93e	2024-09-12 03:42:06	2024-09-12 03:42:06	Cameras	\N
43	Wall Mount Bracket for Dome Camera	100	\N	1	[{"specName":"Brand","specValue":"Quest"},{"specName":"Color","specValue":"White"},{"specName":"Material","specValue":"Plastic"}]	1	5	73e1658f2e	2024-09-12 03:51:13	2024-09-12 03:51:13	Cameras	\N
44	DS-2CE16H0T-ITFS	1000	\N	1	[{"specName":"Brand","specValue":"Hikvision"},{"specName":"Case Type","specValue":"Bullet"},{"specName":"Connectivity Technology","specValue":"Wired"},{"specName":"Resolution","specValue":" 5MP"},{"specName":"Camera Types","specValue":"HD"},{"specName":"Lens","specValue":"3.6mm"},{"specName":"IR Distance","specValue":"21-50m"},{"specName":"WDR","specValue":"DWDR"},{"specName":"Illumination Level","specValue":"Normal"}]	1	2	2ff6dbe976	2024-09-12 09:52:43	2024-09-12 09:52:43	Cameras	\N
45	DS-2CE56D0T-IT3F(C)	700	\N	1	[{"specName":"Brand","specValue":"Hikvision"},{"specName":"Case Type","specValue":"Turret"},{"specName":"Connectivity Technology","specValue":"Wired"},{"specName":"Resolution","specValue":"2MP"},{"specName":"Camera Types","specValue":"HD"},{"specName":"Lens","specValue":"2.8mm\\t"},{"specName":"IR Distance","specValue":" 21-50m"},{"specName":"WDR","specValue":" DWDR"},{"specName":"Illumination Level","specValue":"Normal"},{"specName":"Material","specValue":" Plastic"}]	1	2	d796fcd25a	2024-09-12 10:03:16	2024-09-12 10:03:16	Cameras	\N
46	DS-2CE78K0T-LTS	1200	\N	1	[{"specName":"Brand","specValue":"Hikvision"},{"specName":"Case Type","specValue":" Turret"},{"specName":"Connectivity Technology","specValue":"Wired"},{"specName":"Resolution","specValue":" 5MP"},{"specName":"Camera Types","specValue":"HD"},{"specName":"Lens","specValue":"2.8mm\\t"},{"specName":"IR Distance","specValue":" 21-50m"},{"specName":"WDR","specValue":" DWDR"},{"specName":"Illumination Level","specValue":" Normal"}]	1	2	fc18b82e55	2024-09-12 10:07:55	2024-09-12 10:07:55	Cameras	\N
47	DS-1280ZJ-DM55	50	\N	1	[{"specName":"Brand","specValue":"Hikvision"},{"specName":"Color","specValue":"White"},{"specName":"Mounting Type","specValue":"Ceiling Mount"},{"specName":"Description","specValue":"Junction Box"},{"specName":"Appearance","specValue":"Hikvision White"},{"specName":"Dimension","specValue":"Φ 155 mm × 36 mm (Φ 6.1\\" × 1.42\\")"},{"specName":"Weight","specValue":"300 g (0.66 lb.)"}]	1	5	c5a8538162	2024-09-12 10:36:38	2024-09-12 10:38:03	Cameras	\N
48	DS-3E1105P-EI V2	1000	200	1	[{"specName":"Brand","specValue":"Hikvision"},{"specName":"Port Number","specValue":" 1-5"},{"specName":"PoE","specValue":"Yes"},{"specName":"Port Type","specValue":" 10/100M"}]	1	13	3f91392bfe	2024-09-12 11:05:37	2024-09-12 11:05:37	Cameras	\N
49	DS-3E1508-EI(O-STD)	15000	1400	1	[{"specName":"Brand","specValue":"Hikvision"},{"specName":"Port Number","specValue":" 6-12"},{"specName":"PoE","specValue":" No"},{"specName":"Port Type","specValue":" Gigabit"}]	1	13	c913aa2b61	2024-09-12 11:53:30	2024-09-12 11:53:30	Cameras	\N
23	EZVIZ TY1	100	10	1	[{"specName":"Brand","specValue":"EZVIZ"},{"specName":"Case Type","specValue":"Dome"},{"specName":"Connectivity Technology","specValue":"Wireless"},{"specName":"Resolution","specValue":"2MP"},{"specName":"Camera Types","specValue":"IP"},{"specName":"Lens","specValue":"2.8mm\\t"},{"specName":"IR Distance","specValue":"21-50m"}]	1	2	16601c78aa	2024-09-10 06:07:32	2024-09-12 12:20:52	Cameras	\N
50	WD Purple Surveillance Hard Drive - 1TB	1100	\N	1	[{"specName":"Brand","specValue":"WD"},{"specName":"Capacity","specValue":"1TB"},{"specName":"Form Factor","specValue":"3.5\\""},{"specName":"Interface","specValue":"SATA"},{"specName":"Condition","specValue":"Used"}]	4	14	3e08d983b0	2024-09-16 06:26:50	2024-09-16 06:34:12	Storage Devices	\N
51	WD Purple Surveillance Hard Drive - 2TB	1550	1500	1	[{"specName":"Brand","specValue":"WD"},{"specName":"Capacity","specValue":"2TB"},{"specName":"Form Factor","specValue":"3.5\\""},{"specName":"Interface","specValue":"SATA"},{"specName":"Condition","specValue":"Used"}]	4	14	eb8fbee873	2024-09-16 06:31:56	2024-09-16 06:35:31	Storage Devices	\N
53	HP EliteBook x360 1030 G2 Core™ i7-7600U 256GB SSD 8GB DDR4-SDRAM Intel® HD Graphics 620 13.3" Touchscreen	15000	14500	1	[{"specName":"Brands","specValue":"HP "},{"specName":"Availability","specValue":"In Stock"},{"specName":"GPU/VPU","specValue":"Intel® HD Graphics 620"},{"specName":"CPU Name","specValue":"Intel Core 7th Gen"},{"specName":"CPU Type","specValue":"Intel Core i7"},{"specName":"Touchscreen","specValue":"Yes"},{"specName":"SSD","specValue":"256 GB"},{"specName":"Memory","specValue":"8 GB"},{"specName":"Screen Size","specValue":"13.3 Inch"}]	8	11	fc89d7f1b4	2024-09-18 11:19:36	2024-09-21 20:17:14	Laptops	\N
63	DELL Latitude 5580 Core™ i7-7600U 256GB SSD 8GB DDR4-SDRAM NVIDIA® GeForce® 930MX 15.6" Inch Full HD	13000	12500	1	[{"specName":"Brands","specValue":"Dell"},{"specName":"Availability","specValue":"In Stock"},{"specName":"GPU/VPU","specValue":"NVIDIA® GeForce® 930MX"},{"specName":"CPU Name","specValue":"Intel Core 7th Gen"},{"specName":"CPU Type","specValue":"Intel Core i7"},{"specName":"Touchscreen","specValue":"NO"},{"specName":"SSD","specValue":"256 GB"},{"specName":"Memory","specValue":"8 GB"},{"specName":"Screen Size","specValue":"15.6 Inch"}]	8	11	0c3c34cd22	2024-09-19 10:32:36	2024-09-21 20:38:56	Laptops	\N
61	HP EliteBook 850 G6 Core™ i5-8365U 256GB SSD 8GB DDR4-SDRAM Intel® UHD Graphics 620 15.6" Inch Full HD	14000	13500	1	[{"specName":"Brands","specValue":"HP "},{"specName":"Availability","specValue":"In Stock"},{"specName":"GPU/VPU","specValue":"Intel® HD Graphics 620"},{"specName":"CPU Name","specValue":"Intel Core 8th Gen"},{"specName":"CPU Type","specValue":"Intel Core i5"},{"specName":"Touchscreen","specValue":"NO"},{"specName":"SSD","specValue":"256 GB"},{"specName":"Memory","specValue":"8 GB"},{"specName":"Screen Size","specValue":"15.6 Inch"}]	8	11	43dda53662	2024-09-19 09:24:19	2024-09-21 20:40:42	Laptops	\N
60	HP EliteBook 850 G5 Core™ i5-8350U 256GB SSD 8GB DDR4-SDRAM Intel® UHD Graphics 620 15.6" Inch Full HD	13500	13000	1	[{"specName":"Brands","specValue":"HP "},{"specName":"Availability","specValue":"In Stock"},{"specName":"GPU/VPU","specValue":"Intel® HD Graphics 620"},{"specName":"CPU Name","specValue":"Intel Core 8th Gen"},{"specName":"CPU Type","specValue":"Intel Core i5"},{"specName":"Touchscreen","specValue":"NO"},{"specName":"SSD","specValue":"256 GB"},{"specName":"Memory","specValue":"8 GB"},{"specName":"Screen Size","specValue":"15.6 Inch"}]	8	11	55329d5a49	2024-09-19 09:20:27	2024-09-21 20:41:18	Laptops	\N
59	DELL Precision 5530 Core™ i7-8850H 512GB SSD 16GB DDR4-SDRAM NVIDIA® Quadro® P1000 15.6" Inch Full HD	24000	23000	1	[{"specName":"Brands","specValue":"Dell"},{"specName":"Availability","specValue":"In Stock"},{"specName":"GPU/VPU","specValue":"NVIDIA® Quadro® P1000"},{"specName":"CPU Name","specValue":"Intel Core 8th Gen"},{"specName":"CPU Type","specValue":"Intel Core i7"},{"specName":"Touchscreen","specValue":"NO"},{"specName":"SSD","specValue":"512 GB"},{"specName":"Memory","specValue":"16 GB"},{"specName":"Screen Size","specValue":"15.6 Inch"}]	8	11	9301b40b90	2024-09-19 09:16:10	2024-09-21 20:41:52	Laptops	\N
57	DELL Latitude 5480 Core™ i5-7300HQ 256GB SSD 8GB DDR4-SDRAM Intel® HD Graphics 630 14" Inch HD	8000	7500	1	[{"specName":"Brands","specValue":"Dell"},{"specName":"Availability","specValue":"Out of stock"},{"specName":"GPU/VPU","specValue":"Intel® HD Graphics 630"},{"specName":"CPU Name","specValue":"Intel Core 7th Gen"},{"specName":"CPU Type","specValue":"Intel Core i5"},{"specName":"Touchscreen","specValue":"NO"},{"specName":"SSD","specValue":"256 GB"},{"specName":"Memory","specValue":"8 GB"},{"specName":"Screen Size","specValue":"14 Inch"}]	8	11	f6ad1f902d	2024-09-19 08:50:54	2024-09-21 20:43:40	Laptops	\N
52	HP EliteBook 640 G9 Core™ i5-1245U 512GB SSD 16GB DDR4-SDRAM Intel Iris Xe Graphics 14" Inch Full HD	17000	16000	1	[{"specName":"Brands","specValue":"HP "},{"specName":"Availability","specValue":"In Stock"},{"specName":"GPU/VPU","specValue":"Intel® Iris® Xe Graphics"},{"specName":"CPU Name","specValue":"Intel Core 12th Gen"},{"specName":"CPU Type","specValue":"Intel Core i5"},{"specName":"Touchscreen","specValue":"NO"},{"specName":"SSD","specValue":"512 GB"},{"specName":"Memory","specValue":"16 GB"},{"specName":"Screen Size","specValue":"14 Inch"}]	8	11	2e6d8fdd16	2024-09-18 10:31:47	2024-09-21 20:44:15	Laptops	\N
56	HP ProBook 650 G3  Core™ i5-7440HQ 256GB SSD 8GB DDR4-SDRAM Intel® UHD Graphics 630 15.6" Inch Full HD	9000	8500	1	[{"specName":"Brands","specValue":"HP "},{"specName":"Availability","specValue":"In Stock"},{"specName":"GPU/VPU","specValue":"Intel® HD Graphics 630"},{"specName":"CPU Name","specValue":"Intel Core 7th Gen"},{"specName":"CPU Type","specValue":"Intel Core i5"},{"specName":"Touchscreen","specValue":"NO"},{"specName":"SSD","specValue":"256 GB"},{"specName":"Memory","specValue":"8 GB"},{"specName":"Screen Size","specValue":"15.6 Inch"}]	8	11	c9b55df7c1	2024-09-19 08:42:57	2024-09-21 20:44:51	Laptops	\N
54	HP ProBook 445R G6 AMD Ryzen™ 3 3200U 256GB SSD 8GB DDR4-SDRAM AMD Radeon Vega 3 14" Inch Full HD	9800	9500	1	[{"specName":"Brands","specValue":"HP "},{"specName":"Availability","specValue":"Out of stock"},{"specName":"GPU/VPU","specValue":"AMD Radeon Vega 3"},{"specName":"CPU Name","specValue":"AMD Ryzen 3000 Series"},{"specName":"CPU Type","specValue":"AMD Ryzen 3"},{"specName":"Touchscreen","specValue":"NO"},{"specName":"SSD","specValue":"256 GB"},{"specName":"Memory","specValue":"8 GB"},{"specName":"Screen Size","specValue":"14 Inch"}]	8	11	4badd4f2ed	2024-09-18 12:17:59	2024-09-21 20:45:28	Laptops	\N
62	DELL Latitude E5570 Core™ i7-6820HQ 256GB SSD 8GB DDR4-SDRAM AMD Radeon R7 M370 15.6" Inch Full HD	12000	11500	1	[{"specName":"Brands","specValue":"Dell"},{"specName":"Availability","specValue":"In Stock"},{"specName":"GPU/VPU","specValue":"AMD Radeon R7 M370"},{"specName":"CPU Name","specValue":"Intel Core 6th Gen"},{"specName":"CPU Type","specValue":"Intel Core i7"},{"specName":"Touchscreen","specValue":"NO"},{"specName":"SSD","specValue":"256 GB"},{"specName":"Memory","specValue":"8 GB"},{"specName":"Screen Size","specValue":"15.6 Inch"}]	8	11	2805210c3f	2024-09-19 09:35:06	2024-09-27 02:19:15	Laptops	\N
65	Lenovo LOQ 15IRH8 Intel® Core™ i5-12450H 8GB SO-DIMM DDR5-4800 512GB SSD M.2 RTX™ 2050 4GB GDDR6 15.6" FHD - 82XV00SNED	30250	\N	1	[{"specName":"Brands","specValue":"Lenovo"},{"specName":"Condition","specValue":"New"},{"specName":"CPU Type","specValue":"Intel Core i5"},{"specName":"Screen Size","specValue":"15.6 Inch"},{"specName":"SSD","specValue":"512 GB"},{"specName":"GPU/VPU","specValue":"NVIDIA® GeForce RTX™ 2050 4GB GDDR6"},{"specName":"CPU Name","specValue":"Intel Core 12th Gen"},{"specName":"Memory","specValue":"8 GB"},{"specName":"Video Memory","specValue":"4 GB "}]	8	12	a6560b0b94	2024-09-20 13:54:40	2024-09-20 15:10:51	Laptops	\N
66	Lenovo LOQ 15IAX9 Intel® Core™ i5-12450HX 8GB SO-DIMM DDR5-4800 512GB SSD M.2  RTX™ 3050 6GB GDDR6 15.6" FHD- 83GS008NED	36300	\N	1	[{"specName":"Brands","specValue":"Lenovo"},{"specName":"Condition","specValue":"New"},{"specName":"CPU Type","specValue":"Intel Core i5"},{"specName":"Screen Size","specValue":"15.6 Inch"},{"specName":"SSD","specValue":"512 GB"},{"specName":"GPU/VPU","specValue":"NVIDIA® GeForce RTX™ 3050 6GB GDDR6"},{"specName":"CPU Name","specValue":"Intel Core 12th Gen"},{"specName":"Memory","specValue":"8 GB"},{"specName":"Video Memory","specValue":"6 GB "}]	8	12	5dac1124eb	2024-09-20 14:05:56	2024-09-20 15:13:00	Laptops	\N
67	Lenovo LOQ 15IAX9 Intel® Core™ i5-12450HX 12GB SO-DIMM DDR5-4800 512GB SSD M.2  RTX™ 3050 6GB GDDR6 15.6" FHD- 83GS0087PS	36600	\N	1	[{"specName":"Brands","specValue":"Lenovo"},{"specName":"Condition","specValue":"New"},{"specName":"CPU Type","specValue":"Intel Core i5"},{"specName":"Screen Size","specValue":"15.6 Inch"},{"specName":"SSD","specValue":"512 GB"},{"specName":"GPU/VPU","specValue":"NVIDIA® GeForce RTX™ 3050 6GB GDDR6"},{"specName":"CPU Name","specValue":"Intel Core 12th Gen"},{"specName":"Memory","specValue":"12 GB"},{"specName":"Video Memory","specValue":"6 GB "}]	8	12	bccd760d12	2024-09-20 14:41:21	2024-09-20 15:13:47	Laptops	\N
68	Lenovo LOQ 15IRX9 Intel® Core™ i7-13650HX 16GB SO-DIMM DDR5-4800 512GB SSD M.2 RTX™ 3050 6GB GDDR6 15.6" FHD- 83DV00GDAX	44000	\N	1	[{"specName":"Brands","specValue":"Lenovo"},{"specName":"Condition","specValue":"New"},{"specName":"CPU Type","specValue":"Intel Core i7"},{"specName":"Screen Size","specValue":"15.6 Inch"},{"specName":"SSD","specValue":"512 GB"},{"specName":"GPU/VPU","specValue":"NVIDIA® GeForce RTX™ 3050 6GB GDDR6"},{"specName":"CPU Name","specValue":"Intel Core 13th Gen"},{"specName":"Memory","specValue":"16 GB"},{"specName":"Video Memory","specValue":"6 GB "}]	8	12	89675a7318	2024-09-20 15:34:22	2024-09-20 15:36:07	Laptops	\N
69	Lenovo LOQ 15IRH8 Intel® Core™ i7-13620H 16GB SO-DIMM DDR5-5200 512GB SSD M.2 RTX™ 4050 6GB GDDR6 15.6" FHD- 82XV00SBAX	45500	\N	1	[{"specName":"Brands","specValue":"Lenovo"},{"specName":"Condition","specValue":"New"},{"specName":"CPU Type","specValue":"Intel Core i7"},{"specName":"Screen Size","specValue":"15.6 Inch"},{"specName":"SSD","specValue":"512 GB"},{"specName":"GPU/VPU","specValue":"NVIDIA® GeForce RTX™ 4050 6GB GDDR6"},{"specName":"CPU Name","specValue":"Intel Core 13th Gen"},{"specName":"Memory","specValue":"16 GB"},{"specName":"Video Memory","specValue":"6 GB "}]	8	12	3fed91343d	2024-09-20 15:39:09	2024-09-20 15:39:09	Laptops	\N
70	Lenovo LOQ LOQ 15IRX9 Intel® Core™ i7-13650HX 16GB SO-DIMM DDR5-4800 512GB SSD M.2 RTX™ 4060 8GB GDDR6 15.6" FHD- 83DV006JAX	53000	\N	1	[{"specName":"Brands","specValue":"Lenovo"},{"specName":"Condition","specValue":"New"},{"specName":"CPU Type","specValue":"Intel Core i7"},{"specName":"Screen Size","specValue":"15.6 Inch"},{"specName":"SSD","specValue":"512 GB"},{"specName":"GPU/VPU","specValue":"NVIDIA® GeForce RTX™ 4060 8GB GDDR6"},{"specName":"CPU Name","specValue":"Intel Core 13th Gen"},{"specName":"Memory","specValue":"16 GB"},{"specName":"Video Memory","specValue":"8 GB "}]	8	12	ff747f76dc	2024-09-20 15:43:55	2024-09-20 15:43:55	Laptops	\N
71	HP Victus 15-FB0071NIA AMD Ryzen™ 5 5600H 512 GB PCIe® Gen4 NVMe™ 8 GB DDR4-3200  AMD Radeon™ RX 6500M Graphics (4 GB GDDR6 dedicated) 15.6" Inch FHD	28000	\N	1	[{"specName":"Brands","specValue":"HP "},{"specName":"Condition","specValue":"New"},{"specName":"CPU Type","specValue":"AMD Ryzen 5"},{"specName":"Screen Size","specValue":"15.6 Inch"},{"specName":"SSD","specValue":"512 GB"},{"specName":"GPU/VPU","specValue":"AMD Radeon™ RX 6500M"},{"specName":"CPU Name","specValue":"AMD Ryzen 5000 Series"},{"specName":"Memory","specValue":"8 GB"},{"specName":"Video Memory","specValue":"4 GB "}]	8	12	c2cb546f7c	2024-09-21 04:46:12	2024-09-21 04:46:12	Laptops	\N
64	Lenovo LOQ 15IRH8 Intel® Core™ i5-12450H 16GB SO-DIMM DDR5-4800 512GB SSD M.2 RTX™ 2050 4GB GDDR6 15.6" FHD - 82XV00SNED	31500	\N	1	[{"specName":"Brands","specValue":"Lenovo"},{"specName":"Condition","specValue":"New"},{"specName":"CPU Type","specValue":"Intel Core i5"},{"specName":"Screen Size","specValue":"15.6 Inch"},{"specName":"SSD","specValue":"512 GB"},{"specName":"GPU/VPU","specValue":"NVIDIA® GeForce RTX™ 2050 4GB GDDR6"},{"specName":"CPU Name","specValue":"Intel Core 12th Gen"},{"specName":"Memory","specValue":"16 GB"},{"specName":"Video Memory","specValue":"4 GB "}]	8	12	85f5d38f69	2024-09-20 13:46:49	2024-09-21 17:30:53	Laptops	\N
72	DELL Latitude E5580 Core™ i5-6440HQ 256GB SSD 8GB DDR4-SDRAM NVIDIA® GeForce® 940MX 15.5"Inch Full HD	10700	10500	1	[{"specName":"Brands","specValue":"Dell"},{"specName":"Availability","specValue":"In Stock"},{"specName":"GPU/VPU","specValue":"NVIDIA® GeForce® 940MX"},{"specName":"CPU Name","specValue":"Intel Core 6th Gen"},{"specName":"CPU Type","specValue":"Intel Core i5"},{"specName":"Touchscreen","specValue":"NO"},{"specName":"SSD","specValue":"256 GB"},{"specName":"Memory","specValue":"8 GB"},{"specName":"Screen Size","specValue":"15.6 Inch"}]	8	11	4182ca2b86	2024-09-21 19:46:16	2024-09-21 19:46:16	Laptops	\N
74	DELL Latitude E5580 Core™ i5-6300U 256GB SSD 8GB DDR4-SDRAM Intel® HD Graphics 520 15.5"Inch Full HD	8700	8500	1	[{"specName":"Brands","specValue":"Dell"},{"specName":"Availability","specValue":"In Stock"},{"specName":"GPU/VPU","specValue":"Intel® HD Graphics 520"},{"specName":"CPU Name","specValue":"Intel Core 6th Gen"},{"specName":"CPU Type","specValue":"Intel Core i5"},{"specName":"Touchscreen","specValue":"NO"},{"specName":"SSD","specValue":"256 GB"},{"specName":"Memory","specValue":"8 GB"},{"specName":"Screen Size","specValue":"15.6 Inch"}]	8	11	deab3fe233	2024-09-21 20:08:24	2024-09-21 20:08:24	Laptops	\N
58	HP EliteBook 755 G5	13500	13000	1	[{"specName":"Brands","specValue":"HP "},{"specName":"Availability","specValue":"In Stock"},{"specName":"GPU/VPU","specValue":"AMD Radeon Vega 8"},{"specName":"CPU Name","specValue":"AMD Ryzen 5000 Series"},{"specName":"CPU Type","specValue":"AMD Ryzen 5"},{"specName":"Touchscreen","specValue":"NO"},{"specName":"SSD","specValue":"256 GB"},{"specName":"Memory","specValue":"8 GB"},{"specName":"Screen Size","specValue":"15.6 Inch"}]	8	11	5f7aa0e1f2	2024-09-19 08:58:36	2024-09-21 20:47:31	Laptops	\N
75	Dell 17 Monitor E1715S	800	775	1	[{"specName":"Brands","specValue":"Dell"},{"specName":"Screen Size","specValue":"17\\" Inch"},{"specName":"HDMI","specValue":"NO"},{"specName":"Panel","specValue":"TN"},{"specName":"Display Resolution","specValue":"1280 x 1024"},{"specName":"Condition","specValue":"Used"}]	10	18	179b5b0651	2024-09-22 16:07:16	2024-09-22 16:12:45	Computer Peripherals	\N
77	XPrinter XP-233B Barcode Printer	2350	2150	1	[{"specName":"Product type","specValue":"Printer Barcode"},{"specName":"Brands","specValue":"XPrinter "},{"specName":"Cordless Type","specValue":"Batch"},{"specName":"Condition","specValue":"New"},{"specName":"Print Technology","specValue":"Thermal Line"}]	12	20	7b5ad59f79	2024-09-27 23:00:56	2024-09-27 23:00:56	Printers & Supplies	\N
78	HP 85A LaserJet Toner Cartridge - Black	300	275	1	[{"specName":"Brands","specValue":"HP "},{"specName":"Cartridge Color","specValue":"Black"}]	12	22	7328075b63	2024-09-28 06:04:06	2024-09-28 06:04:06	Printers & Supplies	\N
79	Canon i-SENSYS LBP6030B	7500	7200	1	[{"specName":"Printers Type ","specValue":"Laser Printers"},{"specName":"Brands","specValue":"HP "},{"specName":"Availability","specValue":"In Stock"},{"specName":"Condition","specValue":"New"},{"specName":"Output Type","specValue":"Monochrome"},{"specName":"Duplex printing","specValue":"NO"},{"specName":"Connectivity Technology","specValue":"Wired"}]	12	19	66a8732f0d	2024-09-28 06:15:24	2024-09-28 06:15:24	Printers & Supplies	\N
80	Seething Cash Drawer 405A 6.8kg	1750	1550	1	[{"specName":"Product type","specValue":"Cash Drawer"},{"specName":"Brands","specValue":"Seething "},{"specName":"Condition","specValue":"New"}]	12	20	c3ec6829fa	2024-09-28 06:26:00	2024-09-28 06:26:00	Printers & Supplies	\N
82	Printer X Printer XP-Q371U	1	2950	2595	[{"specName":"Product type","specValue":"Barcode and Receipt"},{"specName":"Brands","specValue":"XPrinter "},{"specName":"Cordless Type","specValue":"Batch"},{"specName":"Interface","specValue":"USB"},{"specName":"Condition","specValue":"New"},{"specName":"Print Technology","specValue":"Thermal Line"}]	12	20	0fa08b48b9	2024-09-29 05:35:57	2024-09-29 05:35:57	Printers & Supplies	\N
81	Printer X Printer XP-246B	2500	2100	1	[{"specName":"Product type","specValue":"Printer Barcode"},{"specName":"Brands","specValue":"XPrinter "},{"specName":"Interface","specValue":"USB"},{"specName":"Condition","specValue":"New"}]	12	20	9698d44fc7	2024-09-29 05:26:47	2024-09-29 09:27:34	Printers & Supplies	\N
76	Datalogic QW2100 Scanner	2500	2350	1	[{"specName":"Product type","specValue":"Barcode Scanner"},{"specName":"Brands","specValue":"Datalogic "},{"specName":"Scan Engine","specValue":"1D"},{"specName":"Interface","specValue":"USB"},{"specName":"Condition","specValue":"New"}]	12	20	c41c1e43b7	2024-09-27 22:55:03	2024-09-29 09:27:48	Printers & Supplies	\N
84	XPrinter XP-D200N Receipt Printer USB+LAN	2750	2550	1	[{"specName":"Product type","specValue":"Printer Receipt"},{"specName":"Brands","specValue":"XPrinter "},{"specName":"Interface","specValue":"Lan / USB"},{"specName":"Condition","specValue":"New"}]	12	20	8cc60ffc5d	2024-09-29 11:25:37	2024-09-29 11:25:37	Printers & Supplies	\N
83	XPrinter XP-D200N Receipt Printer	2500	1975	1	[{"specName":"Product type","specValue":"Printer Receipt"},{"specName":"Brands","specValue":"XPrinter "},{"specName":"Interface","specValue":"USB"},{"specName":"Condition","specValue":"New"}]	12	20	26663859b5	2024-09-29 10:33:51	2024-09-29 11:31:45	Printers & Supplies	\N
85	XPrinter XP-Q806K Receipt Printer	2750	2350	1	[{"specName":"Product type","specValue":"Printer Receipt"},{"specName":"Brands","specValue":"XPrinter "},{"specName":"Interface","specValue":"USB"},{"specName":"Condition","specValue":"New"}]	12	20	d0150805c2	2024-09-29 15:58:01	2024-09-29 15:58:01	Printers & Supplies	\N
86	Syble XB-2058 1D laser barcode scanne	1350	1100	1	[{"specName":"Product type","specValue":"Barcode Scanner"},{"specName":"Brands","specValue":"Syble "},{"specName":"Scan Engine","specValue":"1D"},{"specName":"Interface","specValue":"USB"},{"specName":"Condition","specValue":"New"}]	12	20	a6018c41c7	2024-09-29 16:08:14	2024-09-29 16:08:14	Printers & Supplies	\N
88	U.POS Cash Drawer X4 6.8kg	1750	1600	1	[{"specName":"Product type","specValue":"Cash Drawer"},{"specName":"Brands","specValue":"U.POS "},{"specName":"Condition","specValue":"New"}]	12	20	e900601403	2024-09-29 17:51:02	2024-09-29 17:51:02	Printers & Supplies	\N
90	DHI-USB-U116-20-8GB	150	115	1	[{"specName":"Brands","specValue":"Dahua"},{"specName":"USB Connectors","specValue":"Type A"},{"specName":"Capacity","specValue":"8GB"},{"specName":"Availability","specValue":"In Stock"},{"specName":"Interface","specValue":"USB2.0"},{"specName":"Read Speed","specValue":"10–25 MB/s"}]	4	23	42d4ec2928	2024-10-02 05:15:11	2024-10-02 05:15:11	Storage Devices	\N
92	DHI-USB-U116-20-32GB	160	\N	1	[{"specName":"Brands","specValue":"Dahua"},{"specName":"USB Connectors","specValue":"Type A"},{"specName":"Capacity","specValue":"32GB"},{"specName":"Availability","specValue":"In Stock"}]	4	23	02ce57378d	2024-10-02 05:18:44	2024-10-02 05:18:44	Storage Devices	\N
91	DHI-USB-U116-20-16GB	130	\N	1	[{"specName":"Brands","specValue":"Dahua"},{"specName":"USB Connectors","specValue":"Type A"},{"specName":"Capacity","specValue":"16GB"},{"specName":"Availability","specValue":"In Stock"}]	4	23	ad57b3685d	2024-10-02 05:16:55	2024-10-02 06:03:52	Storage Devices	\N
93	HS-USB-M200-8G	115	\N	1	[{"specName":"Brands","specValue":"Hikvision"},{"specName":"USB Connectors","specValue":"Type A"},{"specName":"Capacity","specValue":"8GB"},{"specName":"Availability","specValue":"In Stock"}]	4	23	a50a9180c9	2024-10-02 06:09:45	2024-10-02 06:09:45	Storage Devices	\N
94	HS-USB-M200-16G	135	\N	1	[{"specName":"Brands","specValue":"Hikvision"},{"specName":"USB Connectors","specValue":"Type A"},{"specName":"Capacity","specValue":"16GB"},{"specName":"Availability","specValue":"In Stock"}]	4	23	d951fb621c	2024-10-02 06:11:20	2024-10-02 06:11:20	Storage Devices	\N
95	HS-USB-M200-32G	160	\N	1	[{"specName":"Brands","specValue":"Hikvision"},{"specName":"USB Connectors","specValue":"Type A"},{"specName":"Capacity","specValue":"32GB"},{"specName":"Availability","specValue":"In Stock"}]	4	23	aac6c6f8c4	2024-10-02 06:12:00	2024-10-02 06:12:00	Storage Devices	\N
96	HS-USB-M200-64G	185	\N	1	[{"specName":"Brands","specValue":"Hikvision"},{"specName":"USB Connectors","specValue":"Type A"},{"specName":"Capacity","specValue":"64GB"},{"specName":"Availability","specValue":"In Stock"}]	4	23	060335ff84	2024-10-02 06:13:13	2024-10-02 06:13:13	Storage Devices	\N
\.


--
-- Data for Name: subcategories; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.subcategories (id, name, img_id, category_id, specifications, created_at, updated_at) FROM stdin;
23	USB Flash Drive & Memory Card	7b8796ce0d	4	["Brands","USB Connectors","Type","Speed Class Rating","Capacity","Availability"]	2024-10-02 04:09:22	2024-10-02 05:10:28
3	Power Supplies	962bd18679	1	["Output Volts","Output Amps","Brand","Material","Waterproof"]	\N	2024-09-10 15:02:49
1	Video Recorders	9385409f0f	1	["Type","Channel Number","Resolution","Brand","Condition","Subseries","Video Input","HDD Interface","Material","POE Interface","Decoding Capability","External Interface","AI","Chassis"]	\N	2024-09-10 18:51:41
2	Security Cameras	66e7d33a59	1	["Brand","Case Type","Connectivity Technology","Resolution","Camera Types","Lens","IR Distance","WDR","Illumination Level","Material"]	\N	2024-09-11 06:36:14
4	Camera Cables	7e8ec65a40	1	["Brand","Cable Length","Cable Type","Color","Ethernet","Coaxial"]	\N	2024-09-11 19:07:48
5	Surveillance Equipment	9feefae9f9	1	["Brand","Color","Material","Mounting Type","Connector Type","Connector Gender"]	\N	2024-09-11 20:57:39
13	Network Switches	17b499548e	1	["Brand","Port Number","PoE","Port Type"]	2024-09-12 10:58:53	2024-09-12 10:58:53
14	Hard Drives	fcb805da6d	4	["Brand","Capacity","Form Factor","Interface","Condition"]	2024-09-16 06:10:16	2024-09-16 06:10:16
15	SSDs	8f589ce2e9	4	["Brand","Capacity","Form Factor","Interface","Condition"]	2024-09-16 06:57:37	2024-09-16 07:02:46
16	Blank Media	6fa3075f12	4	["Brand","Capacity","Type"]	2024-09-16 16:29:15	2024-09-16 16:29:15
11	Used Laptops	48b36edba7	8	["Brands","Availability","GPU/VPU","CPU Name","CPU Type","Touchscreen","SSD","HDD","Memory","Screen Size"]	2024-09-08 06:29:52	2024-09-20 12:33:01
12	Laptops by Request	1fc7f7a682	8	["Brands","Condition","CPU Type","Screen Size","SSD","HDD","GPU/VPU","CPU Name","Memory","Video Memory"]	2024-09-08 06:32:41	2024-09-20 12:53:46
18	Monitors	48c381cbfd	10	["Brands","Screen Size","HDMI","Panel","Display Resolution","Condition"]	2024-09-22 16:05:17	2024-09-22 16:11:34
19	Printers	840954622f	12	["Printers Type ","Brands","Availability","Condition","Output Type","Duplex printing","Connectivity Technology"]	2024-09-27 21:42:09	2024-09-27 21:42:09
22	Printer Ink & Toner	4f44bf510d	12	["Brands","Cartridge Color"]	2024-09-27 22:36:49	2024-09-27 22:36:49
20	Point of Sale	c3be7fe4d2	12	["Product type","Brands","Scan Engine","Interface","Condition"]	2024-09-27 22:24:28	2024-09-29 09:26:14
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.users (id, name, email, email_verified_at, password, remember_token, created_at, updated_at, phone_number, number_verified_at, type) FROM stdin;
3	admin	admin@admin.com	\N	$2y$12$yyNYkWyiHuTq/g0.jHeRW.fA2YD3P.CtHB8up/41gn4B5o6EwvMw.	\N	2025-02-09 18:42:44	2025-02-09 18:42:44	02121212121	\N	customer
4	trader	trader@g.com	\N	$2y$12$cKk6QSf4.sv7bKIkRAwg0O0AdrhugdvIchvBqN9OO/eb4N2S9sWy6	\N	2025-02-17 17:17:28	2025-02-17 17:20:48	01200000000	\N	trader
\.


--
-- Name: brands_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.brands_id_seq', 1, false);


--
-- Name: categories_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.categories_id_seq', 12, true);


--
-- Name: failed_jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.failed_jobs_id_seq', 1, false);


--
-- Name: migrations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.migrations_id_seq', 75, true);


--
-- Name: orders_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.orders_id_seq', 10, true);


--
-- Name: otps_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.otps_id_seq', 1, false);


--
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.personal_access_tokens_id_seq', 1, false);


--
-- Name: products_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.products_id_seq', 96, true);


--
-- Name: subcategories_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.subcategories_id_seq', 23, true);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.users_id_seq', 4, true);


--
-- Name: brands brands_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.brands
    ADD CONSTRAINT brands_pkey PRIMARY KEY (id);


--
-- Name: cache_locks cache_locks_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cache_locks
    ADD CONSTRAINT cache_locks_pkey PRIMARY KEY (key);


--
-- Name: cache cache_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cache
    ADD CONSTRAINT cache_pkey PRIMARY KEY (key);


--
-- Name: categories categories_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.categories
    ADD CONSTRAINT categories_pkey PRIMARY KEY (id);


--
-- Name: failed_jobs failed_jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY (id);


--
-- Name: failed_jobs failed_jobs_uuid_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid);


--
-- Name: migrations migrations_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);


--
-- Name: orders orders_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.orders
    ADD CONSTRAINT orders_pkey PRIMARY KEY (id);


--
-- Name: otps otps_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.otps
    ADD CONSTRAINT otps_pkey PRIMARY KEY (id);


--
-- Name: password_reset_tokens password_reset_tokens_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.password_reset_tokens
    ADD CONSTRAINT password_reset_tokens_pkey PRIMARY KEY (email);


--
-- Name: personal_access_tokens personal_access_tokens_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_pkey PRIMARY KEY (id);


--
-- Name: personal_access_tokens personal_access_tokens_token_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_token_unique UNIQUE (token);


--
-- Name: products products_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.products
    ADD CONSTRAINT products_pkey PRIMARY KEY (id);


--
-- Name: subcategories subcategories_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.subcategories
    ADD CONSTRAINT subcategories_pkey PRIMARY KEY (id);


--
-- Name: users users_email_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);


--
-- Name: users users_phone_number_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_phone_number_unique UNIQUE (phone_number);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: personal_access_tokens_tokenable_type_tokenable_id_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX personal_access_tokens_tokenable_type_tokenable_id_index ON public.personal_access_tokens USING btree (tokenable_type, tokenable_id);


--
-- Name: products_name_specifications_type_fulltext; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX products_name_specifications_type_fulltext ON public.products USING gin ((((to_tsvector('english'::regconfig, name) || to_tsvector('english'::regconfig, specifications)) || to_tsvector('english'::regconfig, type))));


--
-- Name: orders orders_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.orders
    ADD CONSTRAINT orders_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id);


--
-- Name: otps otps_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.otps
    ADD CONSTRAINT otps_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id);


--
-- Name: products products_category_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.products
    ADD CONSTRAINT products_category_id_foreign FOREIGN KEY (category_id) REFERENCES public.categories(id);


--
-- Name: products products_subcategory_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.products
    ADD CONSTRAINT products_subcategory_id_foreign FOREIGN KEY (subcategory_id) REFERENCES public.subcategories(id);


--
-- Name: subcategories subcategories_category_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.subcategories
    ADD CONSTRAINT subcategories_category_id_foreign FOREIGN KEY (category_id) REFERENCES public.categories(id);


--
-- PostgreSQL database dump complete
--

