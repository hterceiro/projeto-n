import React, {FormEvent, useCallback, useState, useEffect} from 'react';
import {Form, Button, Col, Container, Row, Table, ListGroup, InputGroup, FormControl} from "react-bootstrap";
import 'bootstrap/dist/css/bootstrap.min.css';
import {toast, ToastContainer} from "react-toastify";
import 'react-toastify/dist/ReactToastify.css';
import swal from 'sweetalert';
import api from "./services/api";
import apiStatus from "./services/apiStatus";
import {MdDelete} from "react-icons/md";
import './App.css';

interface IList {
    numero: string;
    id: number;
}

interface IStatus {
    countRequest: number;
    countQueries: number;
    serverUpTime: string;
    serverBootTime: string;
}

interface IError {
    violations: Array<{
        message: string;
    }>
}

function App() {
    const [numero, setNumero] = useState("")
    const [lists, setList] = useState<IList[]>([]);
    const [statusList, setStatusList] = useState<IStatus>();
    const [violations, setViolations] = useState<IError[]>([])

    useEffect(() => {
        api.get("/documentos").then(response => {
            const resp = response.data;
            setList(resp);
        })
    }, [statusList]);

    function getStatus() {
        apiStatus.get("/status").then(response => {
            const resp = response.data;
            setStatusList(resp);
        })
    }

    useEffect(() => {
        getStatus()
    }, []);

    const handleSubmit = useCallback(async (event: FormEvent<HTMLFormElement>) => {
        try {
            event.preventDefault();
            const response = await api.post('/documentos', {
                numero,
            });

            if (response.data) {
                toast.success(<span>Cpf/Cnpj: {response.data.numero} <strong>Criado com sucesso!</strong> </span>);
                setList([...lists, response.data])
                setNumero("");
            }
        } catch (error) {
            toast.error("Ocorreu um errro iniesperado:" + error.response.data.detail);
        }
    }, [numero]);

    const deleteCpf = useCallback(async (id) => {
        await swal({
            title: "CUIDADO!",
            text: "Deseja remover mesmo este CPF/CNPJ?",
            icon: "warning",
            buttons: ["cacelar", "Confirmar"],
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                api.delete(`/documentos/${id}`);
                setList(lists.filter(list => list.id !== id));
                toast.error(<b>CPF/CNPJ CANCELADO</b>);
            } else {
                swal("Acção cancelada");
            }
        });
    }, [lists]);

    return (
        <>
            <ToastContainer
                position="top-right"
                autoClose={3000}
                hideProgressBar={false}
                newestOnTop={false}
                closeOnClick
                rtl={false}
                pauseOnFocusLoss
                draggable
                pauseOnHover
            />
            <Container>
                <Row>
                    <Col sm={12}>
                        <ListGroup horizontal={'sm'}>
                            <ListGroup.Item>
                              <strong> Queries: </strong>{statusList?.countQueries}
                            </ListGroup.Item>
                            <ListGroup.Item>
                            <strong> Boottime: </strong> {statusList?.serverBootTime}
                            </ListGroup.Item>
                            <ListGroup.Item>
                            <strong> Uptime: </strong> {statusList?.serverUpTime}
                            </ListGroup.Item>
                        </ListGroup>
                    </Col>
                </Row>
                <Row>
                    <Col sm>
                        <Form className="align-items-center" onSubmit={handleSubmit}>
                                <Form.Row className="align-items-center">
                                    <Col xs="auto">
                                        <Form.Label htmlFor="inlineFormInputGroup" srOnly>
                                            DOCUMENTO
                                        </Form.Label>
                                        <InputGroup className="mb-2">
                                            <FormControl placeholder="Digite o seu CPF ou CNPJ"
                                                         value={numero}
                                                         onChange={event => setNumero(event.target.value)} name="numero"
                                                         type="text"/>
                                        </InputGroup>
                                    </Col>
                                    <Col xs="auto">
                                        <Button type="submit" className="mb-2">
                                            Cadastrar
                                        </Button>
                                    </Col>
                                </Form.Row>
                            </Form>
                    </Col>
                </Row>
                <Row>
                    <Col sm>
                        <Table striped bordered hover size="sm">
                            <thead>
                            <tr>
                                <th>CPF/CNPJ</th>
                                <th>Ações</th>
                            </tr>
                            </thead>
                            <tbody>

                            {lists.map(list => {
                                    return (
                                        <tr key={list.id}>
                                            <td className="align-middle" align={"left"}>{list.numero} </td>
                                            <td align={"left"}>
                                                <Button variant="danger" onClick={
                                                    () => deleteCpf(list.id)
                                                }><MdDelete/></Button>
                                            </td>
                                        </tr>
                                    )
                                }
                            )}
                            </tbody>
                        </Table>
                    </Col>
                </Row>
            </Container>
        </>
    );
}

export default App;
