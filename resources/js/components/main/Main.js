import { Container, Row, Col } from 'bootstrap-4-react';
import './Main.scss';
import React, { Component } from 'react';
import {Route, BrowserRouter, Switch } from 'react-router-dom';
import { TitleTarget } from '../teleporters/Title'
import Helmet from "react-helmet";
import Navbar from './Navbar';
import Footer from "./Footer";
import ArticleForm from '../article/ArticleForm';
import ArticleList from '../article/ArticleList';
import ArticlePage from '../article/ArticlePage';

class Main extends Component
{
    render(){
        return (
            <>
            <BrowserRouter>
              <Helmet>
                <title>Blog</title>
              </Helmet>
              <div className="app">
                <Navbar/>
                <header className="app-header">
                    <Container>
                      <Row>
                        <Col col="sm-12">
                          <TitleTarget/>
                        </Col>
                      </Row>
                    </Container>
                </header>
                <div className="wrap">
                    <Container>
                        <div className="content">
                            <Switch>
                                <Route exact path="/" component={ArticleList}/>
                                <Route path="/article-add" component={ArticleForm}/>
                                <Route path="/article/:slug" component={ArticlePage}/>
                            </Switch>
                        </div>
                    </Container>
                </div>
                <Footer/>
              </div>
            </BrowserRouter>
          </>
        );
    }
}

export default Main;
