import React, {FormEvent, useCallback, useState, useEffect} from 'react';
import {Form, Button, Col, Container, Row, Table} from "react-bootstrap";
import 'bootstrap/dist/css/bootstrap.min.css';
import {toast, ToastContainer} from "react-toastify";
import 'react-toastify/dist/ReactToastify.css';
import swal from 'sweetalert';
import api from "./services/api";
import apiStatus from "./services/apiStatus";
import {MdDelete} from "react-icons/md";

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

function App() {
    const [numero, setNumero] = useState("")
    const [lists, setList] = useState<IList[]>([]);
    const [statusList, setStatusList] = useState<IStatus>();

    useEffect(() => {
        api.get("/documentos").then(response => {
            const resp = response.data;
            setList(resp);
        })
    }, [statusList]);

    useEffect(() => {
        apiStatus.get("/status").then(response => {
            const resp = response.data;
            setStatusList(resp);
            console.log(resp)
        })
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
            toast.error("Verifique se seus dados estão corretos");
            console.log(error)
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
                    <Col>
                        <Form onSubmit={handleSubmit}>
                            <Form.Row>
                                <Col xs={30}>
                                    <Form.Group controlId="numero">
                                        <Form.Label>DOCUMENTO</Form.Label>
                                        <Form.Control placeholder="Numero: Cpf/cnpj"
                                                      value={numero}
                                                      onChange={event => setNumero(event.target.value)} name="numero"
                                                      type="text"/>
                                    </Form.Group>
                                </Col>
                            </Form.Row>
                            <Form.Row>
                                <Col xs={30}>
                                    <Button type="submit">
                                        Salvar
                                    </Button>
                                </Col>
                            </Form.Row>
                        </Form>
                    </Col>
                    <Col>
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
                                            <td align={"center"}>{list.numero} </td>
                                            <td align={"center"}>
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
                <Row>
                    <Table striped bordered hover size="sm">
                        <thead>
                        <tr>
                            <th>Quantidade de Consultas</th>
                            <th>Server BootTime</th>
                            <th>Server Uptime</th>
                        </tr>
                        </thead>
                        <tbody>
                        <td>{statusList?.countQueries}</td>
                        <td>{statusList?.serverBootTime}</td>
                        <td>{statusList?.serverUpTime}</td>
                        </tbody>
                    </Table>
                </Row>
            </Container>
        </>
    );
}

export default App;
