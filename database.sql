--
-- PostgreSQL database dump
--

\restrict o4Q03UYunlx4VphY0nMfH0EYLD2KJx5fE8NBVHqI86qKGma2wcHHrUDCpDyzPOw

-- Dumped from database version 17.6
-- Dumped by pg_dump version 18.2

-- Started on 2026-04-27 13:20:18

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
-- TOC entry 4919 (class 0 OID 0)
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
-- TOC entry 4920 (class 0 OID 0)
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
-- TOC entry 4921 (class 0 OID 0)
-- Dependencies: 217
-- Name: produits_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.produits_id_seq OWNED BY public.produits.id;


--
-- TOC entry 4753 (class 2604 OID 16402)
-- Name: commandes id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.commandes ALTER COLUMN id SET DEFAULT nextval('public.commandes_id_seq'::regclass);


--
-- TOC entry 4755 (class 2604 OID 16411)
-- Name: ligne_commande id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ligne_commande ALTER COLUMN id SET DEFAULT nextval('public.ligne_commande_id_seq'::regclass);


--
-- TOC entry 4752 (class 2604 OID 16392)
-- Name: produits id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.produits ALTER COLUMN id SET DEFAULT nextval('public.produits_id_seq'::regclass);


--
-- TOC entry 4911 (class 0 OID 16399)
-- Dependencies: 220
-- Data for Name: commandes; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.commandes (id, date_commande, total_general) FROM stdin;
1	2026-04-21 20:12:43.526025	\N
2	2026-04-21 20:35:02.16163	\N
3	2026-04-22 00:32:16.075119	\N
4	2026-04-22 00:36:21.899782	\N
\.


--
-- TOC entry 4913 (class 0 OID 16408)
-- Dependencies: 222
-- Data for Name: ligne_commande; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.ligne_commande (id, id_commande, id_produit, quantite) FROM stdin;
1	1	1	1
2	2	1	2
3	3	3	1
4	4	3	1
\.


--
-- TOC entry 4909 (class 0 OID 16389)
-- Dependencies: 218
-- Data for Name: produits; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.produits (id, nom, prix, description) FROM stdin;
1	PC Portable	1500.00	Laptop high tech
2	Souris	25.50	Souris sans fil
3	Clavier	75.00	Clavier mécanique
\.


--
-- TOC entry 4922 (class 0 OID 0)
-- Dependencies: 219
-- Name: commandes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.commandes_id_seq', 4, true);


--
-- TOC entry 4923 (class 0 OID 0)
-- Dependencies: 221
-- Name: ligne_commande_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.ligne_commande_id_seq', 4, true);


--
-- TOC entry 4924 (class 0 OID 0)
-- Dependencies: 217
-- Name: produits_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.produits_id_seq', 3, true);


--
-- TOC entry 4759 (class 2606 OID 16405)
-- Name: commandes commandes_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.commandes
    ADD CONSTRAINT commandes_pkey PRIMARY KEY (id);


--
-- TOC entry 4761 (class 2606 OID 16413)
-- Name: ligne_commande ligne_commande_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ligne_commande
    ADD CONSTRAINT ligne_commande_pkey PRIMARY KEY (id);


--
-- TOC entry 4757 (class 2606 OID 16396)
-- Name: produits produits_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.produits
    ADD CONSTRAINT produits_pkey PRIMARY KEY (id);


--
-- TOC entry 4762 (class 2606 OID 16414)
-- Name: ligne_commande ligne_commande_id_commande_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ligne_commande
    ADD CONSTRAINT ligne_commande_id_commande_fkey FOREIGN KEY (id_commande) REFERENCES public.commandes(id);


-- Completed on 2026-04-27 13:20:18

--
-- PostgreSQL database dump complete
--

\unrestrict o4Q03UYunlx4VphY0nMfH0EYLD2KJx5fE8NBVHqI86qKGma2wcHHrUDCpDyzPOw

