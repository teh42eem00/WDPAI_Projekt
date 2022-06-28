--
-- PostgreSQL database dump
--

-- Dumped from database version 14.4 (Ubuntu 14.4-1.pgdg20.04+1)
-- Dumped by pg_dump version 14.4

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

--
-- Name: public; Type: SCHEMA; Schema: -; Owner: orvdsboljgwpld
--

CREATE SCHEMA public;


ALTER SCHEMA public OWNER TO orvdsboljgwpld;

--
-- Name: SCHEMA public; Type: COMMENT; Schema: -; Owner: orvdsboljgwpld
--

COMMENT ON SCHEMA public IS 'standard public schema';


--
-- Name: get_expense_category_percentage(integer, integer); Type: FUNCTION; Schema: public; Owner: orvdsboljgwpld
--

CREATE FUNCTION public.get_expense_category_percentage(carid integer, expensetypeid integer) RETURNS double precision
    LANGUAGE plpgsql
    AS $$
declare
    category_sum float;
    full_sum     float;
begin
    select sum(expense_amount)
    into full_sum
    from expenses
    where id_car = carId;

    select sum(expense_amount)
    into category_sum
    from expenses
    where id_car = carId
      and expense_type_id = expenseTypeId;

    return round((category_sum / full_sum)::DECIMAL, 2);
end;
$$;


ALTER FUNCTION public.get_expense_category_percentage(carid integer, expensetypeid integer) OWNER TO orvdsboljgwpld;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: car_setup; Type: TABLE; Schema: public; Owner: orvdsboljgwpld
--

CREATE TABLE public.car_setup (
    car_setup_id integer NOT NULL,
    brand character varying NOT NULL,
    model character varying NOT NULL,
    production_year integer NOT NULL
);


ALTER TABLE public.car_setup OWNER TO orvdsboljgwpld;

--
-- Name: cars; Type: TABLE; Schema: public; Owner: orvdsboljgwpld
--

CREATE TABLE public.cars (
    id_car integer NOT NULL,
    id_user integer NOT NULL,
    car_setup_id integer NOT NULL,
    license_plate character varying NOT NULL
);


ALTER TABLE public.cars OWNER TO orvdsboljgwpld;

--
-- Name: car_details; Type: VIEW; Schema: public; Owner: orvdsboljgwpld
--

CREATE VIEW public.car_details AS
 SELECT cars.id_car,
    cars.id_user,
    cs.brand,
    cs.model,
    cs.production_year,
    cars.license_plate
   FROM (public.cars
     JOIN public.car_setup cs ON ((cs.car_setup_id = cars.car_setup_id)));


ALTER TABLE public.car_details OWNER TO orvdsboljgwpld;

--
-- Name: car_setup_car_setup_id_seq; Type: SEQUENCE; Schema: public; Owner: orvdsboljgwpld
--

CREATE SEQUENCE public.car_setup_car_setup_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.car_setup_car_setup_id_seq OWNER TO orvdsboljgwpld;

--
-- Name: car_setup_car_setup_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: orvdsboljgwpld
--

ALTER SEQUENCE public.car_setup_car_setup_id_seq OWNED BY public.car_setup.car_setup_id;


--
-- Name: cars_id_car_seq; Type: SEQUENCE; Schema: public; Owner: orvdsboljgwpld
--

CREATE SEQUENCE public.cars_id_car_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.cars_id_car_seq OWNER TO orvdsboljgwpld;

--
-- Name: cars_id_car_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: orvdsboljgwpld
--

ALTER SEQUENCE public.cars_id_car_seq OWNED BY public.cars.id_car;


--
-- Name: expenses; Type: TABLE; Schema: public; Owner: orvdsboljgwpld
--

CREATE TABLE public.expenses (
    expense_id integer NOT NULL,
    expense_type_id integer NOT NULL,
    expense_amount numeric,
    id_car integer,
    mileage integer,
    created_at date NOT NULL
);


ALTER TABLE public.expenses OWNER TO orvdsboljgwpld;

--
-- Name: expense_sum; Type: VIEW; Schema: public; Owner: orvdsboljgwpld
--

CREATE VIEW public.expense_sum AS
 SELECT sum(expenses.expense_amount) AS sum
   FROM public.expenses;


ALTER TABLE public.expense_sum OWNER TO orvdsboljgwpld;

--
-- Name: expense_types; Type: TABLE; Schema: public; Owner: orvdsboljgwpld
--

CREATE TABLE public.expense_types (
    expense_type_id integer NOT NULL,
    expense_type character varying NOT NULL
);


ALTER TABLE public.expense_types OWNER TO orvdsboljgwpld;

--
-- Name: expense_types_expense_type_id_seq; Type: SEQUENCE; Schema: public; Owner: orvdsboljgwpld
--

CREATE SEQUENCE public.expense_types_expense_type_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.expense_types_expense_type_id_seq OWNER TO orvdsboljgwpld;

--
-- Name: expense_types_expense_type_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: orvdsboljgwpld
--

ALTER SEQUENCE public.expense_types_expense_type_id_seq OWNED BY public.expense_types.expense_type_id;


--
-- Name: expenses_expense_id_seq; Type: SEQUENCE; Schema: public; Owner: orvdsboljgwpld
--

CREATE SEQUENCE public.expenses_expense_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.expenses_expense_id_seq OWNER TO orvdsboljgwpld;

--
-- Name: expenses_expense_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: orvdsboljgwpld
--

ALTER SEQUENCE public.expenses_expense_id_seq OWNED BY public.expenses.expense_id;


--
-- Name: expenses_with_types; Type: VIEW; Schema: public; Owner: orvdsboljgwpld
--

CREATE VIEW public.expenses_with_types AS
 SELECT expenses.expense_id,
    expenses.expense_type_id,
    expenses.id_car,
    expenses.expense_amount,
    et.expense_type,
    expenses.mileage,
    expenses.created_at
   FROM (public.expenses
     JOIN public.expense_types et ON ((et.expense_type_id = expenses.expense_type_id)))
  ORDER BY expenses.created_at DESC;


ALTER TABLE public.expenses_with_types OWNER TO orvdsboljgwpld;

--
-- Name: role; Type: TABLE; Schema: public; Owner: orvdsboljgwpld
--

CREATE TABLE public.role (
    id_role integer NOT NULL,
    role character varying NOT NULL
);


ALTER TABLE public.role OWNER TO orvdsboljgwpld;

--
-- Name: role_id_role_seq; Type: SEQUENCE; Schema: public; Owner: orvdsboljgwpld
--

CREATE SEQUENCE public.role_id_role_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.role_id_role_seq OWNER TO orvdsboljgwpld;

--
-- Name: role_id_role_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: orvdsboljgwpld
--

ALTER SEQUENCE public.role_id_role_seq OWNED BY public.role.id_role;


--
-- Name: user; Type: TABLE; Schema: public; Owner: orvdsboljgwpld
--

CREATE TABLE public."user" (
    user_id integer NOT NULL,
    id_role integer NOT NULL,
    firstname character varying,
    lastname character varying,
    email character varying,
    password_hash character varying,
    created_at date
);


ALTER TABLE public."user" OWNER TO orvdsboljgwpld;

--
-- Name: user_user_id_seq; Type: SEQUENCE; Schema: public; Owner: orvdsboljgwpld
--

CREATE SEQUENCE public.user_user_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.user_user_id_seq OWNER TO orvdsboljgwpld;

--
-- Name: user_user_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: orvdsboljgwpld
--

ALTER SEQUENCE public.user_user_id_seq OWNED BY public."user".user_id;


--
-- Name: car_setup car_setup_id; Type: DEFAULT; Schema: public; Owner: orvdsboljgwpld
--

ALTER TABLE ONLY public.car_setup ALTER COLUMN car_setup_id SET DEFAULT nextval('public.car_setup_car_setup_id_seq'::regclass);


--
-- Name: cars id_car; Type: DEFAULT; Schema: public; Owner: orvdsboljgwpld
--

ALTER TABLE ONLY public.cars ALTER COLUMN id_car SET DEFAULT nextval('public.cars_id_car_seq'::regclass);


--
-- Name: expense_types expense_type_id; Type: DEFAULT; Schema: public; Owner: orvdsboljgwpld
--

ALTER TABLE ONLY public.expense_types ALTER COLUMN expense_type_id SET DEFAULT nextval('public.expense_types_expense_type_id_seq'::regclass);


--
-- Name: expenses expense_id; Type: DEFAULT; Schema: public; Owner: orvdsboljgwpld
--

ALTER TABLE ONLY public.expenses ALTER COLUMN expense_id SET DEFAULT nextval('public.expenses_expense_id_seq'::regclass);


--
-- Name: role id_role; Type: DEFAULT; Schema: public; Owner: orvdsboljgwpld
--

ALTER TABLE ONLY public.role ALTER COLUMN id_role SET DEFAULT nextval('public.role_id_role_seq'::regclass);


--
-- Name: user user_id; Type: DEFAULT; Schema: public; Owner: orvdsboljgwpld
--

ALTER TABLE ONLY public."user" ALTER COLUMN user_id SET DEFAULT nextval('public.user_user_id_seq'::regclass);


--
-- Data for Name: car_setup; Type: TABLE DATA; Schema: public; Owner: orvdsboljgwpld
--

INSERT INTO public.car_setup (car_setup_id, brand, model, production_year) VALUES (1, 'Honda', 'Accord', 2003);
INSERT INTO public.car_setup (car_setup_id, brand, model, production_year) VALUES (2, 'Honda', 'Civic', 2010);
INSERT INTO public.car_setup (car_setup_id, brand, model, production_year) VALUES (10, 'honda', 'jazz', 2006);
INSERT INTO public.car_setup (car_setup_id, brand, model, production_year) VALUES (11, 'honda', 'logo', 2009);
INSERT INTO public.car_setup (car_setup_id, brand, model, production_year) VALUES (12, 'opel', 'astra', 2002);
INSERT INTO public.car_setup (car_setup_id, brand, model, production_year) VALUES (13, 'mazda', '5', 2003);
INSERT INTO public.car_setup (car_setup_id, brand, model, production_year) VALUES (14, 'tesla', '3', 2020);
INSERT INTO public.car_setup (car_setup_id, brand, model, production_year) VALUES (15, 'Toyota', 'Yaris', 2003);
INSERT INTO public.car_setup (car_setup_id, brand, model, production_year) VALUES (16, 'tesla', '1', 1);


--
-- Data for Name: cars; Type: TABLE DATA; Schema: public; Owner: orvdsboljgwpld
--

INSERT INTO public.cars (id_car, id_user, car_setup_id, license_plate) VALUES (2, 2, 2, 'KR22222');
INSERT INTO public.cars (id_car, id_user, car_setup_id, license_plate) VALUES (6, 2, 10, 'kwi11111');
INSERT INTO public.cars (id_car, id_user, car_setup_id, license_plate) VALUES (7, 2, 11, 'kwi11111');
INSERT INTO public.cars (id_car, id_user, car_setup_id, license_plate) VALUES (8, 6, 12, 'kr1234');
INSERT INTO public.cars (id_car, id_user, car_setup_id, license_plate) VALUES (11, 7, 15, 'KR 90909');
INSERT INTO public.cars (id_car, id_user, car_setup_id, license_plate) VALUES (15, 2, 16, '1');
INSERT INTO public.cars (id_car, id_user, car_setup_id, license_plate) VALUES (16, 2, 16, '2');
INSERT INTO public.cars (id_car, id_user, car_setup_id, license_plate) VALUES (17, 2, 16, '453');


--
-- Data for Name: expense_types; Type: TABLE DATA; Schema: public; Owner: orvdsboljgwpld
--

INSERT INTO public.expense_types (expense_type_id, expense_type) VALUES (1, 'Fuel');
INSERT INTO public.expense_types (expense_type_id, expense_type) VALUES (2, 'Service');
INSERT INTO public.expense_types (expense_type_id, expense_type) VALUES (3, 'Expenses');


--
-- Data for Name: expenses; Type: TABLE DATA; Schema: public; Owner: orvdsboljgwpld
--

INSERT INTO public.expenses (expense_id, expense_type_id, expense_amount, id_car, mileage, created_at) VALUES (15, 2, 200, 2, 2000, '2022-06-27');
INSERT INTO public.expenses (expense_id, expense_type_id, expense_amount, id_car, mileage, created_at) VALUES (16, 2, 1000, 2, 10250, '2022-06-22');
INSERT INTO public.expenses (expense_id, expense_type_id, expense_amount, id_car, mileage, created_at) VALUES (17, 3, 100, 2, 1000, '2022-04-27');
INSERT INTO public.expenses (expense_id, expense_type_id, expense_amount, id_car, mileage, created_at) VALUES (18, 2, 100, 2, 10250, '2022-06-27');
INSERT INTO public.expenses (expense_id, expense_type_id, expense_amount, id_car, mileage, created_at) VALUES (19, 3, 200, 2, 15000, '2022-06-28');
INSERT INTO public.expenses (expense_id, expense_type_id, expense_amount, id_car, mileage, created_at) VALUES (21, 1, 1000, 6, 1000, '2022-06-28');
INSERT INTO public.expenses (expense_id, expense_type_id, expense_amount, id_car, mileage, created_at) VALUES (22, 2, 1000, 2, 15555, '2022-06-27');
INSERT INTO public.expenses (expense_id, expense_type_id, expense_amount, id_car, mileage, created_at) VALUES (23, 2, 1000, 2, 15, '2022-06-29');
INSERT INTO public.expenses (expense_id, expense_type_id, expense_amount, id_car, mileage, created_at) VALUES (26, 2, 1000, 2, 15, '2022-06-29');


--
-- Data for Name: role; Type: TABLE DATA; Schema: public; Owner: orvdsboljgwpld
--

INSERT INTO public.role (id_role, role) VALUES (1, 'user');
INSERT INTO public.role (id_role, role) VALUES (2, 'admin');


--
-- Data for Name: user; Type: TABLE DATA; Schema: public; Owner: orvdsboljgwpld
--

INSERT INTO public."user" (user_id, id_role, firstname, lastname, email, password_hash, created_at) VALUES (2, 2, 'tomek', 'macalka', 'tomek@pk.edu.pl', '$2y$10$xNXVznXe.DP0ycroyxlEBeNgSluTy4hFMTEZ9SDfG2bviRLapT4yW', '2022-05-29');
INSERT INTO public."user" (user_id, id_role, firstname, lastname, email, password_hash, created_at) VALUES (6, 1, 'test', 'test', 'tomek2@pk.edu.pl', '$2y$10$ccuveGqG9A54ARQtQTNM7.Ul.RfVtlO0UtT44Jx5Oiloo1cCIEO6K', '2022-06-24');
INSERT INTO public."user" (user_id, id_role, firstname, lastname, email, password_hash, created_at) VALUES (7, 1, 'tomek', 'test', 'tomek3@pk.edu.pl', '$2y$10$H172PEzvDCn9ERpUPn9F2u5dLnfVrUO8L9IlH3Nqfl5sR/6TAd.3e', '2022-06-25');


--
-- Name: car_setup_car_setup_id_seq; Type: SEQUENCE SET; Schema: public; Owner: orvdsboljgwpld
--

SELECT pg_catalog.setval('public.car_setup_car_setup_id_seq', 16, true);


--
-- Name: cars_id_car_seq; Type: SEQUENCE SET; Schema: public; Owner: orvdsboljgwpld
--

SELECT pg_catalog.setval('public.cars_id_car_seq', 17, true);


--
-- Name: expense_types_expense_type_id_seq; Type: SEQUENCE SET; Schema: public; Owner: orvdsboljgwpld
--

SELECT pg_catalog.setval('public.expense_types_expense_type_id_seq', 1, false);


--
-- Name: expenses_expense_id_seq; Type: SEQUENCE SET; Schema: public; Owner: orvdsboljgwpld
--

SELECT pg_catalog.setval('public.expenses_expense_id_seq', 27, true);


--
-- Name: role_id_role_seq; Type: SEQUENCE SET; Schema: public; Owner: orvdsboljgwpld
--

SELECT pg_catalog.setval('public.role_id_role_seq', 1, false);


--
-- Name: user_user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: orvdsboljgwpld
--

SELECT pg_catalog.setval('public.user_user_id_seq', 7, true);


--
-- Name: car_setup car_setup_pk; Type: CONSTRAINT; Schema: public; Owner: orvdsboljgwpld
--

ALTER TABLE ONLY public.car_setup
    ADD CONSTRAINT car_setup_pk PRIMARY KEY (car_setup_id);


--
-- Name: cars cars_pk; Type: CONSTRAINT; Schema: public; Owner: orvdsboljgwpld
--

ALTER TABLE ONLY public.cars
    ADD CONSTRAINT cars_pk PRIMARY KEY (id_car);


--
-- Name: expense_types expense_types_pk; Type: CONSTRAINT; Schema: public; Owner: orvdsboljgwpld
--

ALTER TABLE ONLY public.expense_types
    ADD CONSTRAINT expense_types_pk PRIMARY KEY (expense_type_id);


--
-- Name: expenses expenses_pk; Type: CONSTRAINT; Schema: public; Owner: orvdsboljgwpld
--

ALTER TABLE ONLY public.expenses
    ADD CONSTRAINT expenses_pk PRIMARY KEY (expense_id);


--
-- Name: role role_pk; Type: CONSTRAINT; Schema: public; Owner: orvdsboljgwpld
--

ALTER TABLE ONLY public.role
    ADD CONSTRAINT role_pk PRIMARY KEY (id_role);


--
-- Name: user user_pk; Type: CONSTRAINT; Schema: public; Owner: orvdsboljgwpld
--

ALTER TABLE ONLY public."user"
    ADD CONSTRAINT user_pk PRIMARY KEY (user_id);


--
-- Name: car_setup_car_setup_id_uindex; Type: INDEX; Schema: public; Owner: orvdsboljgwpld
--

CREATE UNIQUE INDEX car_setup_car_setup_id_uindex ON public.car_setup USING btree (car_setup_id);


--
-- Name: cars_id_car_uindex; Type: INDEX; Schema: public; Owner: orvdsboljgwpld
--

CREATE UNIQUE INDEX cars_id_car_uindex ON public.cars USING btree (id_car);


--
-- Name: expense_types_expense_type_id_uindex; Type: INDEX; Schema: public; Owner: orvdsboljgwpld
--

CREATE UNIQUE INDEX expense_types_expense_type_id_uindex ON public.expense_types USING btree (expense_type_id);


--
-- Name: expenses_expense_id_uindex; Type: INDEX; Schema: public; Owner: orvdsboljgwpld
--

CREATE UNIQUE INDEX expenses_expense_id_uindex ON public.expenses USING btree (expense_id);


--
-- Name: role_id_role_uindex; Type: INDEX; Schema: public; Owner: orvdsboljgwpld
--

CREATE UNIQUE INDEX role_id_role_uindex ON public.role USING btree (id_role);


--
-- Name: user_user_id_uindex; Type: INDEX; Schema: public; Owner: orvdsboljgwpld
--

CREATE UNIQUE INDEX user_user_id_uindex ON public."user" USING btree (user_id);


--
-- Name: cars cars_car_setup_car_setup_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: orvdsboljgwpld
--

ALTER TABLE ONLY public.cars
    ADD CONSTRAINT cars_car_setup_car_setup_id_fk FOREIGN KEY (car_setup_id) REFERENCES public.car_setup(car_setup_id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: expenses expenses_cars_id_car_fk; Type: FK CONSTRAINT; Schema: public; Owner: orvdsboljgwpld
--

ALTER TABLE ONLY public.expenses
    ADD CONSTRAINT expenses_cars_id_car_fk FOREIGN KEY (id_car) REFERENCES public.cars(id_car) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: expenses expenses_expense_types_expense_type_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: orvdsboljgwpld
--

ALTER TABLE ONLY public.expenses
    ADD CONSTRAINT expenses_expense_types_expense_type_id_fk FOREIGN KEY (expense_type_id) REFERENCES public.expense_types(expense_type_id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: user user_role_id_role_fk; Type: FK CONSTRAINT; Schema: public; Owner: orvdsboljgwpld
--

ALTER TABLE ONLY public."user"
    ADD CONSTRAINT user_role_id_role_fk FOREIGN KEY (id_role) REFERENCES public.role(id_role) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: SCHEMA public; Type: ACL; Schema: -; Owner: orvdsboljgwpld
--

REVOKE ALL ON SCHEMA public FROM postgres;
REVOKE ALL ON SCHEMA public FROM PUBLIC;
GRANT ALL ON SCHEMA public TO orvdsboljgwpld;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- Name: LANGUAGE plpgsql; Type: ACL; Schema: -; Owner: postgres
--

GRANT ALL ON LANGUAGE plpgsql TO orvdsboljgwpld;


--
-- PostgreSQL database dump complete
--

