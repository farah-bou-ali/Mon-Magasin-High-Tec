--
-- PostgreSQL database dump
--

\restrict cuUuu2MC4sRdNVfXM62W4eZBn4KeeHUjnHJxdXUNLazg7vEsAsoW8MwoQvfKAX0

-- Dumped from database version 17.6
-- Dumped by pg_dump version 18.2

-- Started on 2026-04-29 20:44:25

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
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
-- TOC entry 224 (class 1259 OID 16445)
-- Name: admins; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.admins (
    id integer NOT NULL,
    username character varying(50) NOT NULL,
    password character varying(255) NOT NULL
);


ALTER TABLE public.admins OWNER TO postgres;

--
-- TOC entry 223 (class 1259 OID 16444)
-- Name: admins_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.admins_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.admins_id_seq OWNER TO postgres;

--
-- TOC entry 4943 (class 0 OID 0)
-- Dependencies: 223
-- Name: admins_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.admins_id_seq OWNED BY public.admins.id;


--
-- TOC entry 226 (class 1259 OID 16454)
-- Name: clients; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.clients (
    id integer NOT NULL,
    nom_complet character varying(100) NOT NULL,
    email character varying(100) NOT NULL,
    mot_de_passe character varying(255) NOT NULL,
    adresse text
);


ALTER TABLE public.clients OWNER TO postgres;

--
-- TOC entry 225 (class 1259 OID 16453)
-- Name: clients_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.clients_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.clients_id_seq OWNER TO postgres;

--
-- TOC entry 4944 (class 0 OID 0)
-- Dependencies: 225
-- Name: clients_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.clients_id_seq OWNED BY public.clients.id;


--
-- TOC entry 220 (class 1259 OID 16399)
-- Name: commandes; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.commandes (
    id integer NOT NULL,
    date_commande timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    total_general numeric(10,2)
);


ALTER TABLE public.commandes OWNER TO postgres;

--
-- TOC entry 219 (class 1259 OID 16398)
-- Name: commandes_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.commandes_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.commandes_id_seq OWNER TO postgres;

--
-- TOC entry 4945 (class 0 OID 0)
-- Dependencies: 219
-- Name: commandes_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.commandes_id_seq OWNED BY public.commandes.id;


--
-- TOC entry 222 (class 1259 OID 16408)
-- Name: ligne_commande; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.ligne_commande (
    id integer NOT NULL,
    id_commande integer,
    id_produit integer,
    quantite integer
);


ALTER TABLE public.ligne_commande OWNER TO postgres;

--
-- TOC entry 221 (class 1259 OID 16407)
-- Name: ligne_commande_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.ligne_commande_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.ligne_commande_id_seq OWNER TO postgres;

--
-- TOC entry 4946 (class 0 OID 0)
-- Dependencies: 221
-- Name: ligne_commande_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.ligne_commande_id_seq OWNED BY public.ligne_commande.id;


--
-- TOC entry 218 (class 1259 OID 16389)
-- Name: produits; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.produits (
    id integer NOT NULL,
    nom character varying(100) NOT NULL,
    prix numeric(10,2) NOT NULL,
    description text
);


ALTER TABLE public.produits OWNER TO postgres;

--
-- TOC entry 217 (class 1259 OID 16388)
-- Name: produits_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.produits_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.produits_id_seq OWNER TO postgres;

--
-- TOC entry 4947 (class 0 OID 0)
-- Dependencies: 217
-- Name: produits_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.produits_id_seq OWNED BY public.produits.id;


--
-- TOC entry 4766 (class 2604 OID 16448)
-- Name: admins id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.admins ALTER COLUMN id SET DEFAULT nextval('public.admins_id_seq'::regclass);


--
-- TOC entry 4767 (class 2604 OID 16457)
-- Name: clients id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.clients ALTER COLUMN id SET DEFAULT nextval('public.clients_id_seq'::regclass);


--
-- TOC entry 4763 (class 2604 OID 16402)
-- Name: commandes id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.commandes ALTER COLUMN id SET DEFAULT nextval('public.commandes_id_seq'::regclass);


--
-- TOC entry 4765 (class 2604 OID 16411)
-- Name: ligne_commande id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ligne_commande ALTER COLUMN id SET DEFAULT nextval('public.ligne_commande_id_seq'::regclass);


--
-- TOC entry 4762 (class 2604 OID 16392)
-- Name: produits id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.produits ALTER COLUMN id SET DEFAULT nextval('public.produits_id_seq'::regclass);


--
-- TOC entry 4935 (class 0 OID 16445)
-- Dependencies: 224
-- Data for Name: admins; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.admins (id, username, password) FROM stdin;
1	admin	123
\.


--
-- TOC entry 4937 (class 0 OID 16454)
-- Dependencies: 226
-- Data for Name: clients; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.clients (id, nom_complet, email, mot_de_passe, adresse) FROM stdin;
1	farah bouali 	boualifarah443@gmail.com	farah	\N
\.


--
-- TOC entry 4931 (class 0 OID 16399)
-- Dependencies: 220
-- Data for Name: commandes; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.commandes (id, date_commande, total_general) FROM stdin;
6	2026-04-29 20:06:11.962907	1500.00
\.


--
-- TOC entry 4933 (class 0 OID 16408)
-- Dependencies: 222
-- Data for Name: ligne_commande; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.ligne_commande (id, id_commande, id_produit, quantite) FROM stdin;
\.


--
-- TOC entry 4929 (class 0 OID 16389)
-- Dependencies: 218
-- Data for Name: produits; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.produits (id, nom, prix, description) FROM stdin;
1	PC Portable	1500.00	Laptop high tech
2	Souris	25.50	Souris sans fil
3	Clavier	75.00	Clavier mécanique
\.


--
-- TOC entry 4948 (class 0 OID 0)
-- Dependencies: 223
-- Name: admins_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.admins_id_seq', 1, true);


--
-- TOC entry 4949 (class 0 OID 0)
-- Dependencies: 225
-- Name: clients_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.clients_id_seq', 1, true);


--
-- TOC entry 4950 (class 0 OID 0)
-- Dependencies: 219
-- Name: commandes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.commandes_id_seq', 6, true);


--
-- TOC entry 4951 (class 0 OID 0)
-- Dependencies: 221
-- Name: ligne_commande_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.ligne_commande_id_seq', 6, true);


--
-- TOC entry 4952 (class 0 OID 0)
-- Dependencies: 217
-- Name: produits_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.produits_id_seq', 3, true);


--
-- TOC entry 4775 (class 2606 OID 16450)
-- Name: admins admins_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.admins
    ADD CONSTRAINT admins_pkey PRIMARY KEY (id);


--
-- TOC entry 4777 (class 2606 OID 16452)
-- Name: admins admins_username_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.admins
    ADD CONSTRAINT admins_username_key UNIQUE (username);


--
-- TOC entry 4779 (class 2606 OID 16463)
-- Name: clients clients_email_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.clients
    ADD CONSTRAINT clients_email_key UNIQUE (email);


--
-- TOC entry 4781 (class 2606 OID 16461)
-- Name: clients clients_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.clients
    ADD CONSTRAINT clients_pkey PRIMARY KEY (id);


--
-- TOC entry 4771 (class 2606 OID 16405)
-- Name: commandes commandes_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.commandes
    ADD CONSTRAINT commandes_pkey PRIMARY KEY (id);


--
-- TOC entry 4773 (class 2606 OID 16413)
-- Name: ligne_commande ligne_commande_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ligne_commande
    ADD CONSTRAINT ligne_commande_pkey PRIMARY KEY (id);


--
-- TOC entry 4769 (class 2606 OID 16396)
-- Name: produits produits_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.produits
    ADD CONSTRAINT produits_pkey PRIMARY KEY (id);


--
-- TOC entry 4782 (class 2606 OID 16414)
-- Name: ligne_commande ligne_commande_id_commande_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ligne_commande
    ADD CONSTRAINT ligne_commande_id_commande_fkey FOREIGN KEY (id_commande) REFERENCES public.commandes(id);


-- Completed on 2026-04-29 20:44:26

--
-- PostgreSQL database dump complete
--

\unrestrict cuUuu2MC4sRdNVfXM62W4eZBn4KeeHUjnHJxdXUNLazg7vEsAsoW8MwoQvfKAX0

