//
//  main.cpp
//  scanner
//
//  Created by 满江杰 on 6/4/15.
//  Copyright (c) 2015 满江杰. All rights reserved.
//

#include <stdlib.h>
#include <string.h>
#include <stdio.h>

#define _filename_max 100
#define _buffer_size 100
#define _word_size 50
#define _keyword_number 48

char	ch;							//当前搜索的字符
char	last_ch;					//前一个字符
FILE	*fin;						//被编译的文件
FILE	* fout;						//输出的信息文件
FILE	* fstdout;					//要求输出的属性字流
int		block_annotation_flag = 0;	//块注释标记，为1时处于块注释
int		row_annotation_flag = 0;	//行注释标记，为1时处于行注释
int		space_flag = 0;				//空格标记，为1时处于空格状态
int		string_flag = 0;			//是否处于字符串中
int		buffer_count = 0;			//缓冲区当前字符个数
int		buffer_index = 0;			//当前字符在缓冲区中的位置
char	buffer[_buffer_size];		//缓冲区
int		file_off_flag = 0;			//文件是否结束,1时文件结束
int		end_flag = 0;				//是否分析结束，1时结束
int		ret_flag = 0;				//是否处于回退状态，若在回退状态，则申请字符时不读取下一个字符
char    word[_word_size];			//存当前搜索的字符串
int		word_count = 0;				//当前搜索的字符串长
int		row_count = 1;				//当前行号
int		cur_row_cout = 0;			//当前行单词个数
int		all_count = 0;				//程序单词总个数

char * keyword[_keyword_number] = { "abstract", "boolean", "break", "byte", "case", "catch", "char", "class", "const", "continue", "default",
    "do","double","else","extends","final","finally","float","for","goto","if","implements",
    "import","instanceof","int","interface","long","native","new","null","package","private","protected",
    "public","return","short","static","super","switch","synchronized","this","throw","throws","transient",
    "try","void","volatile","while"};
char * boolconst[2] = { "true", "false" };

void LoadBuffer();					//加载缓冲区,会过滤注释，多余的空格
void NextCh();						//从缓冲区读取下一个字符，缓冲区读完时会要求加载缓冲区
void DFA_0();						//DFA状态0，类似
int IsAlphabet(char c);				//是否是字母,是返回1，否则返回0
int IsNumber(char c);				//是否是数字,是返回1，否则返回0
void RetChar();						//回退一个字符
void ErrorPrint();					//输出错误信息

void DFA_1();
void DFA_2();
void DFA_3();
void DFA_4();
void DFA_5();
void DFA_6();
void DFA_7();
void DFA_8();
void DFA_9();
void DFA_10();

void DFA_11();
void DFA_12();
void DFA_13();
void DFA_14();
void DFA_15();
void DFA_16();
void DFA_17();
void DFA_18();
void DFA_19();
void DFA_20();

void DFA_21();
void DFA_22();
void DFA_23();
void DFA_24();
void DFA_25();
void DFA_26();
//void DFA_27();
void DFA_28();
void DFA_29();
void DFA_30();

void DFA_31();
void DFA_32();
void DFA_33();
void DFA_34();
void DFA_35();
void DFA_36();
void DFA_37();
void DFA_38();
void DFA_39();
void DFA_40();

void DFA_41();
void DFA_42();
void DFA_43();
void DFA_44();
void DFA_45();
void DFA_46();
void DFA_47();
void DFA_48();
void DFA_49();
void DFA_50();

void DFA_51();
void DFA_52();
void DFA_53();
void DFA_54();
void DFA_55();
void DFA_56();
void DFA_57();
void DFA_58();
void DFA_59();
void DFA_60();

void DFA_61();
void DFA_62();
void DFA_63();
void DFA_64();
void DFA_65();
void DFA_66();
void DFA_67();
void DFA_68();
void DFA_69();
void DFA_70();

void DFA_71();
//void DFA_72();
void DFA_73();
void DFA_74();
void DFA_75();
void DFA_76();
void DFA_77();
void DFA_78();
void DFA_79();
void DFA_80();
//void DFA_81();
//void DFA_82();
void DFA_83();
void DFA_84();


int _tmain(int argc, _TCHAR* argv[])
{
    char filename[_filename_max];
    
    printf("请输入要编译的文件名\n");
    scanf_s("%s", filename);
    if ((fin = fopen(filename, "r")) == NULL)
    {
        printf("cannot open file %s \n",filename);
        exit(0);
    }
    if ((fout = fopen("scanner_log", "w")) == NULL)
    {
        printf("cannot open file %s \n", filename);
        exit(0);
    }
    if ((fstdout = fopen("scanner_output", "wb")) == NULL)
    {
        printf("cannot open file %s \n", filename);
        exit(0);
    }
    
    DFA_0();		//开始进行词法分析，进入第0个状态
    
    fclose(fin);
    fclose(fout);
    fclose(fstdout);
    
    return 0;
}

int IsAlphabet(char c)
{
    if ( (c >= 'a' && c <='z') || (c>='A' && c <= 'Z') )
        return 1;
    else
        return 0;
}
int IsNumber(char c)
{
    if (c >= '0' && c <= '9')
        return 1;
    else
        return 0;
}

void NextCh()
{
    if (ret_flag == 1)
    {
        ret_flag = 0;
        return;
    }
    if (buffer_count == 0 && file_off_flag == 0)		//缓冲区为空时，加载缓冲区
    {
        LoadBuffer();
        buffer_index = 0;
    }
    if (buffer_index == buffer_count)					//缓冲区用完
    {
        if (file_off_flag == 0)							//文件未读完
        {
            LoadBuffer();
            buffer_index = 0;
        }
        else                                            //文件读完，缓冲区也用完,停止编译
        {
            end_flag = 1;
        }
    }
    last_ch = ch;
    ch = buffer[buffer_index++];						//读下一个字符
}
void RetChar()
{
    ret_flag = 1;
    word_count--;
}
void ErrorPrint()
{
    word[word_count] = '\0';
    char str[5];
    _itoa(row_count,str,10);
    fputs("error in line ", fout);
    fputs(str, fout);
    fputs(" at: ", fout);
    fputs(word, fout);
    fputs("\n", fout);
    word_count = 0;
}
void LoadBuffer()
{
    char temp_ch;
    char temp_ch2;
    buffer_count = 0;
    while (buffer_count < _buffer_size - 1)   //  -1 以免一次写入2个字符造成缓冲区溢出
    {
        if (!feof(fin))		//文件未到末尾
        {
            temp_ch = fgetc(fin);
            if (block_annotation_flag == 1)   //块注释中
            {
                if (!feof(fin))
                {
                    if (temp_ch == '*' && (temp_ch2 = fgetc(fin)) == '/')
                    {
                        block_annotation_flag = 0;		//遇到 "*/" 结束块注释
                        continue;
                    }
                    else
                    {
                        continue;						//否则跳过
                    }
                }
                else
                {
                    continue;
                }
            }
            if (row_annotation_flag == 1)		//行注释中
            {
                if (temp_ch == '\n')			//遇到换行结束，且将换行加入缓冲区
                {
                    row_annotation_flag = 0;
                    buffer[buffer_count++] = temp_ch;
                    continue;
                }
                else
                {
                    continue;					//否则跳过
                }
            }
            if (string_flag == 0 && space_flag == 1)    //在非字符串的空格状态
            {
                if (temp_ch == ' ' || temp_ch == '\t')
                    continue;
                else
                {
                    space_flag = 0;
                    buffer[buffer_count++] = temp_ch;
                    continue;
                }
            }
            if (string_flag == 1)         //字符串中
            {
                if (temp_ch == '"')
                {
                    string_flag = 0;
                }
                buffer[buffer_count++] = temp_ch;
                continue;
            }
            if (string_flag == 0 && space_flag == 0)    //非字符串遇到空格
            {
                if (temp_ch == ' ' || temp_ch == '\t')
                {
                    space_flag = 1;
                }
                buffer[buffer_count++] = temp_ch;
                continue;
            }
            if (temp_ch == '/')					//检查是否是注释
            {
                if (!feof(fin))
                {
                    temp_ch2 = fgetc(fin);
                    if (temp_ch2 == '*')			//是块注释开始，不写入缓冲区
                    {
                        block_annotation_flag = 1;
                        continue;
                    }
                    else if (temp_ch2 == '/')	//是行注释开始
                    {
                        row_annotation_flag = 1;
                        continue;
                    }
                    else    //不是块注释开始，写入缓冲区   小心造成缓冲区溢出
                    {
                        buffer[buffer_count++] = temp_ch;
                        buffer[buffer_count++] = temp_ch2;
                        continue;
                    }
                }
                else
                {
                    buffer[buffer_count++] = temp_ch;
                    continue;
                }
            }
            //一般情况，直接写入缓冲区
            buffer[buffer_count++] = temp_ch;
        }
        else		//文件到达末尾,检查当前状态
        {
            printf("file off\n");
            file_off_flag = 1;
            break;
        }
    }
}

void DFA_0()
{
    while (end_flag == 0)
    {
        NextCh();
        word[word_count++] = ch;
        if (end_flag == 1)		//文件词法分析完成，结束
            break;
        if (ch == '$' || ch == '_')
        {
            DFA_1();
            continue;
        }
        if (IsAlphabet(ch))
        {
            DFA_3();
            continue;
        }
        if (ch == '-')
        {
            DFA_5();
            continue;
        }
        if (ch == '0')
        {
            DFA_6();
            continue;
        }
        if (ch > '0' && ch <='9')
        {
            DFA_7();
            continue;
        }
        if (ch =='.')
        {
            DFA_83();
            continue;
        }
        if (ch == '\'')
        {
            DFA_14();
            continue;
        }
        if (ch == '"')
        {
            DFA_17();
            continue;
        }
        if (ch == '=')
        {
            DFA_20();
            continue;
        }
        if (ch == '+')
        {
            DFA_23();
            continue;
        }
        if (ch == '*')
        {
            DFA_31();
            continue;
        }
        if (ch == '/')
        {
            DFA_34();
            continue;
        }
        if (ch == '%')
        {
            DFA_37();
            continue;
        }
        if (ch == '&')
        {
            DFA_40();
            continue;
        }
        if (ch == '^')
        {
            DFA_44();
            continue;
        }
        if (ch == '|')
        {
            DFA_47();
            continue;
        }
        if (ch == '>')
        {
            DFA_51();
            continue;
        }
        if (ch == '<')
        {
            DFA_60();
            continue;
        }
        if (ch == '?')
        {
            DFA_66();
            continue;
        }
        if (ch == '!')
        {
            DFA_68();
            continue;
        }
        if (ch == '[')
        {
            DFA_71();
            continue;
        }
        if (ch == ']')
        {
            DFA_73();
            continue;
        }
        if (ch == '(')
        {
            DFA_74();
            continue;
        }
        if (ch == ')')
        {
            DFA_75();
            continue;
        }
        if (ch == ',')
        {
            DFA_76();
            continue;
        }
        if (ch == '{')
        {
            DFA_78();
            continue;
        }
        if (ch == '}')
        {
            DFA_79();
            continue;
        }
        if (ch == ';')
        {
            DFA_80();
            continue;
        }
        
        if (ch == ' ')
        {
            word_count = 0;
            continue;
        }
        if (ch == '\t')
        {
            word_count = 0;
            continue;
        }
        if (ch == '\n')
        {
            char str[5],sword[5];
            _itoa(row_count, str, 10);
            _itoa(cur_row_cout, sword, 10);
            fputs("line ",fout);
            fputs(str, fout);
            fputs(" has word: ", fout);
            fputs(sword, fout);
            fputs("\n", fout);
            
            row_count++;
            cur_row_cout = 0;
            word_count = 0;
            continue;
        }
        if (ch == -1)    //结束符
        {
            if (last_ch != '\n')
            {
                char str[5], sword[5];
                _itoa(row_count, str, 10);
                _itoa(cur_row_cout, sword, 10);
                fputs("line ", fout);
                fputs(str, fout);
                fputs(" has word: ", fout);
                fputs(sword, fout);
                fputs("\n", fout);
            }
            
            char str[5];
            _itoa(all_count, str, 10);
            fputs("program has word: ", fout);
            fputs(str, fout);
            fputs("\n", fout);
            break;
        }
        ErrorPrint();
    }
}

void DFA_1()
{
    NextCh();
    word[word_count++] = ch;
    if (IsAlphabet(ch) || ch == '$' || ch == '_' || IsNumber(ch))
        DFA_1();
    else
    {
        DFA_2();
    }
    ErrorPrint();
}

void DFA_2()
{
    RetChar();				//需要回退1个字符
    //输出
    word[word_count] = '\0';
    fputs("标识符 ", fout);
    fputs(word, fout);
    fputs("\n", fout);
    
    fprintf(fstdout,"104");
    
    cur_row_cout++;
    all_count++;
    word_count = 0;			//清空搜索的字符串
}

void DFA_3()
{
    NextCh();
    word[word_count++] = ch;
    if (IsAlphabet(ch))
    {
        DFA_3();
        return;
    }
    if (IsNumber(ch))
    {
        DFA_1();
        return;
    }
    DFA_4();
}

void DFA_4()
{
    RetChar();				//需要回退1个字符
    //输出
    word[word_count] = '\0';
    for (int i = 0; i < _keyword_number; i++)
    {
        if (strcmp(word, keyword[i]) == 0)
        {
            fputs("关键字 ", fout);
            fputs(word, fout);
            fputs("\n", fout);
            word_count = 0;
            fprintf(fstdout, "103");
            cur_row_cout++;
            all_count++;
            return;
        }
    }
    for (int i = 0; i < 2; i++)
    {
        if (strcmp(word, boolconst[i]) == 0)
        {
            fputs("布尔常量 ", fout);
            fputs(word, fout);
            fputs("\n", fout);
            fprintf(fstdout, "105");
            cur_row_cout++;
            all_count++;
            word_count = 0;
            return;
        }
    }
    fputs("标识符 ", fout);
    fputs(word, fout);
    fputs("\n", fout);
    fprintf(fstdout, "104");
    cur_row_cout++;
    all_count++;
    word_count = 0;			//清空搜索的字符串
}

void DFA_5()
{
    NextCh();
    word[word_count++] = ch;
    if (ch == '0')
    {
        DFA_6();
        return;
    }
    if (ch > '0' && ch <= '9')
    {
        DFA_7();
        return;
    }
    if (ch == '-')
    {
        DFA_28();
        return;
    }
    if (ch == '=')
    {
        DFA_29();
        return;
    }
    DFA_30();
}

void DFA_6()
{
    NextCh();
    word[word_count++] = ch;
    if (ch == '0')
    {
        DFA_7();
        return;
    }
    if (ch == 'x' || ch == 'X')
    {
        DFA_8();
        return;
    }
    ErrorPrint();
}

void DFA_7()
{
    NextCh();
    word[word_count++] = ch;
    if (IsNumber(ch))
    {
        DFA_7();
        return;
    }
    if (ch == 'L')
    {
        DFA_10();
        return;
    }
    if (ch == '.' || ch =='e' || ch =='E')
    {
        DFA_11();
        return;
    }
    DFA_9();
}

void DFA_8()
{
    NextCh();
    word[word_count++] = ch;
    if (IsNumber(ch))
    {
        DFA_8();
        return;
    }
    DFA_9();
}

void DFA_9()
{
    RetChar();				//需要回退1个字符
    //输出
    word[word_count] = '\0';
    fputs("整型常量 ", fout);
    fputs(word, fout);
    fputs("\n", fout);
    fprintf(fstdout, "107");
    
    cur_row_cout++;
    all_count++;
    word_count = 0;			//清空搜索的字符串
}

void DFA_10()
{
    //输出
    word[word_count] = '\0';
    fputs("整型常量 ", fout);
    fputs(word, fout);
    fputs("\n", fout);
    fprintf(fstdout, "107");
    
    cur_row_cout++;
    all_count++;
    word_count = 0;			//清空搜索的字符串
}

void DFA_11()
{
    NextCh();
    word[word_count++] = ch;
    if (IsNumber(ch))
    {
        DFA_11();
        return;
    }
    if (ch == 'F')
    {
        DFA_12();
        return;
    }
    DFA_13();
}

void DFA_12()
{
    //输出
    word[word_count] = '\0';
    fputs("实型常量 ", fout);
    fputs(word, fout);
    fputs("\n", fout);
    fprintf(fstdout, "108");
    
    cur_row_cout++;
    all_count++;
    word_count = 0;			//清空搜索的字符串
}

void DFA_13()
{
    RetChar();
    //输出
    word[word_count] = '\0';
    fputs("实型常量 ", fout);
    fputs(word, fout);
    fputs("\n", fout);
    fprintf(fstdout, "108");
    
    cur_row_cout++;
    all_count++;
    word_count = 0;			//清空搜索的字符串
}

void DFA_14()
{
    NextCh();
    word[word_count++] = ch;
    if (IsAlphabet(ch))
    {
        DFA_15();
        return;
    }
    ErrorPrint();
}

void DFA_15()
{
    NextCh();
    word[word_count++] = ch;
    if (ch == '\'')
    {
        DFA_16();
        return;
    }
    ErrorPrint();
}

void DFA_16()
{
    //输出
    word[word_count] = '\0';
    fputs("字符常量 ", fout);
    fputs(word, fout);
    fputs("\n", fout);
    fprintf(fstdout, "106");
    
    cur_row_cout++;
    all_count++;
    word_count = 0;			//清空搜索的字符串
}

void DFA_17()
{
    NextCh();
    word[word_count++] = ch;
    if (IsAlphabet(ch) || ch == ' ')
    {
        DFA_18();
        return;
    }
    ErrorPrint();
}

void DFA_18()
{
    NextCh();
    word[word_count++] = ch;
    if (ch == '"')
    {
        DFA_19();
        return;
    }
    if (ch == ' ' || IsAlphabet(ch))
    {
        DFA_18();
        return;
    }
    ErrorPrint();
}

void DFA_19()
{
    //输出
    word[word_count] = '\0';
    fputs("字符串常量 ", fout);
    fputs(word, fout);
    fputs("\n", fout);
    fprintf(fstdout, "109");
    
    cur_row_cout++;
    all_count++;
    word_count = 0;			//清空搜索的字符串
}

void DFA_20()
{
    NextCh();
    word[word_count++] = ch;
    if (ch == '=')
    {
        DFA_21();
        return;
    }
    DFA_22();
}

void DFA_21()
{
    //输出
    word[word_count] = '\0';
    fputs("相等 ", fout);
    fputs(word, fout);
    fputs("\n", fout);
    fprintf(fstdout, "117");
    
    cur_row_cout++;
    all_count++;
    word_count = 0;			//清空搜索的字符串
}

void DFA_22()
{
    RetChar();
    //输出
    word[word_count] = '\0';
    fputs("赋值 ", fout);
    fputs(word, fout);
    fputs("\n", fout);
    fprintf(fstdout, "110");
    
    cur_row_cout++;
    all_count++;
    word_count = 0;			//清空搜索的字符串
}

void DFA_23()
{
    NextCh();
    word[word_count++] = ch;
    if (ch == '+')
    {
        DFA_24();
        return;
    }
    if (ch == '=')
    {
        DFA_25();
        return;
    }
    DFA_26();
}

void DFA_24()
{
    //输出
    word[word_count] = '\0';
    fputs("自加 ", fout);
    fputs(word, fout);
    fputs("\n", fout);
    fprintf(fstdout, "11c");
    
    cur_row_cout++;
    all_count++;
    word_count = 0;			//清空搜索的字符串
}

void DFA_25()
{
    //输出
    word[word_count] = '\0';
    fputs("加等 ", fout);
    fputs(word, fout);
    fputs("\n", fout);
    fprintf(fstdout, "110");
    
    cur_row_cout++;
    all_count++;
    word_count = 0;			//清空搜索的字符串
}

void DFA_26()
{
    //输出
    word[word_count] = '\0';
    fputs("加号 ", fout);
    fputs(word, fout);
    fputs("\n", fout);
    fprintf(fstdout, "11a");
    
    cur_row_cout++;
    all_count++;
    word_count = 0;			//清空搜索的字符串
}

void DFA_28()
{
    //输出
    word[word_count] = '\0';
    fputs("自减 ", fout);
    fputs(word, fout);
    fputs("\n", fout);
    fprintf(fstdout, "11c");
    
    cur_row_cout++;
    all_count++;
    word_count = 0;			//清空搜索的字符串
}

void DFA_29()
{
    //输出
    word[word_count] = '\0';
    fputs("减等于 ", fout);
    fputs(word, fout);
    fputs("\n", fout);
    fprintf(fstdout, "110");
    
    cur_row_cout++;
    all_count++;
    word_count = 0;			//清空搜索的字符串
}

void DFA_30()
{
    RetChar();
    //输出
    word[word_count] = '\0';
    fputs("减号 ", fout);
    fputs(word, fout);
    fputs("\n", fout);
    fprintf(fstdout, "11a");
    
    cur_row_cout++;
    all_count++;
    word_count = 0;			//清空搜索的字符串
}

void DFA_31()
{
    NextCh();
    word[word_count++] = ch;
    if (ch == '=')
    {
        DFA_32();
        return;
    }
    DFA_33();
}

void DFA_32()
{
    //输出
    word[word_count] = '\0';
    fputs("乘等 ", fout);
    fputs(word, fout);
    fputs("\n", fout);
    fprintf(fstdout, "110");
    
    cur_row_cout++;
    all_count++;
    word_count = 0;			//清空搜索的字符串
}

void DFA_33()
{
    RetChar();
    //输出
    word[word_count] = '\0';
    fputs("乘号 ", fout);
    fputs(word, fout);
    fputs("\n", fout);
    fprintf(fstdout, "11b");
    
    cur_row_cout++;
    all_count++;
    word_count = 0;			//清空搜索的字符串
}

void DFA_34()
{
    NextCh();
    word[word_count++] = ch;
    if (ch == '=')
    {
        DFA_35();
        return;
    }
    DFA_36();
}

void DFA_35()
{
    //输出
    word[word_count] = '\0';
    fputs("除等 ", fout);
    fputs(word, fout);
    fputs("\n", fout);
    fprintf(fstdout, "110");
    
    cur_row_cout++;
    all_count++;
    word_count = 0;			//清空搜索的字符串
}

void DFA_36()
{
    RetChar();
    //输出
    word[word_count] = '\0';
    fputs("除号 ", fout);
    fputs(word, fout);
    fputs("\n", fout);
    fprintf(fstdout, "11b");
    
    cur_row_cout++;
    all_count++;
    word_count = 0;			//清空搜索的字符串
}

void DFA_37()
{
    NextCh();
    word[word_count++] = ch;
    if (ch == '=')
    {
        DFA_38();
        return;
    }
    DFA_39();
}

void DFA_38()
{
    //输出
    word[word_count] = '\0';
    fputs("模等 ", fout);
    fputs(word, fout);
    fputs("\n", fout);
    fprintf(fstdout, "110");
    
    cur_row_cout++;
    all_count++;
    word_count = 0;			//清空搜索的字符串
}

void DFA_39()
{
    RetChar();
    //输出
    word[word_count] = '\0';
    fputs("取模 ", fout);
    fputs(word, fout);
    fputs("\n", fout);
    fprintf(fstdout, "11b");
    
    cur_row_cout++;
    all_count++;
    word_count = 0;			//清空搜索的字符串
}

void DFA_40()
{
    NextCh();
    word[word_count++] = ch;
    if (ch == '=')
    {
        DFA_41();
        return;
    }
    if (ch == '&')
    {
        DFA_42();
        return;
    }
    DFA_43();
}

void DFA_41()
{
    //输出
    word[word_count] = '\0';
    fputs("与等 ", fout);
    fputs(word, fout);
    fputs("\n", fout);
    fprintf(fstdout, "110");
    
    cur_row_cout++;
    all_count++;
    word_count = 0;			//清空搜索的字符串
}

void DFA_42()
{
    //输出
    word[word_count] = '\0';
    fputs("且 ", fout);
    fputs(word, fout);
    fputs("\n", fout);
    fprintf(fstdout, "113");
    
    cur_row_cout++;
    all_count++;
    word_count = 0;			//清空搜索的字符串
}

void DFA_43()
{
    RetChar();
    //输出
    word[word_count] = '\0';
    fputs("逻辑与 ", fout);
    fputs(word, fout);
    fputs("\n", fout);
    fprintf(fstdout, "116");
    
    cur_row_cout++;
    all_count++;
    word_count = 0;			//清空搜索的字符串
}

void DFA_44()
{
    NextCh();
    word[word_count++] = ch;
    if (ch == '=')
    {
        DFA_45();
        return;
    }
    DFA_46();
}

void DFA_45()
{
    //输出
    word[word_count] = '\0';
    fputs("异或等 ", fout);
    fputs(word, fout);
    fputs("\n", fout);
    fprintf(fstdout, "110");
    
    cur_row_cout++;
    all_count++;
    word_count = 0;			//清空搜索的字符串
}

void DFA_46()
{
    RetChar();
    //输出
    word[word_count] = '\0';
    fputs("异或 ", fout);
    fputs(word, fout);
    fputs("\n", fout);
    fprintf(fstdout, "115");
    
    cur_row_cout++;
    all_count++;
    word_count = 0;			//清空搜索的字符串
}

void DFA_47()
{
    NextCh();
    word[word_count++] = ch;
    if (ch == '|')
    {
        DFA_48();
        return;
    }
    if (ch == '=')
    {
        DFA_49();
        return;
    }
    DFA_50();
}

void DFA_48()
{
    //输出
    word[word_count] = '\0';
    fputs("或者 ", fout);
    fputs(word, fout);
    fputs("\n", fout);
    fprintf(fstdout, "112");
    
    cur_row_cout++;
    all_count++;
    word_count = 0;			//清空搜索的字符串
}

void DFA_49()
{
    //输出
    word[word_count] = '\0';
    fputs("或等 ", fout);
    fputs(word, fout);
    fputs("\n", fout);
    fprintf(fstdout, "110");
    
    cur_row_cout++;
    all_count++;
    word_count = 0;			//清空搜索的字符串
}

void DFA_50()
{
    RetChar();
    //输出
    word[word_count] = '\0';
    fputs("逻辑或 ", fout);
    fputs(word, fout);
    fputs("\n", fout);
    fprintf(fstdout, "114");
    
    cur_row_cout++;
    all_count++;
    word_count = 0;			//清空搜索的字符串
}

void DFA_51()
{
    NextCh();
    word[word_count++] = ch;
    if (ch == '=')
    {
        DFA_52();
        return;
    }
    if (ch == '>')
    {
        DFA_53();
        return;
    }
    DFA_59();
}

void DFA_52()
{
    //输出
    word[word_count] = '\0';
    fputs("大于等于 ", fout);
    fputs(word, fout);
    fputs("\n", fout);
    fprintf(fstdout, "118");
    
    cur_row_cout++;
    all_count++;
    word_count = 0;			//清空搜索的字符串
}

void DFA_53()
{
    NextCh();
    word[word_count++] = ch;
    if (ch == '=')
    {
        DFA_57();
        return;
    }
    if (ch == '>')
    {
        DFA_54();
        return;
    }
    DFA_58();
}

void DFA_54()
{
    NextCh();
    word[word_count++] = ch;
    if (ch == '=')
    {
        DFA_55();
        return;
    }
    DFA_56();
}

void DFA_55()
{
    //输出
    word[word_count] = '\0';
    fputs("零填充右移位赋值 ", fout);
    fputs(word, fout);
    fputs("\n", fout);
    fprintf(fstdout, "110");
    
    cur_row_cout++;
    all_count++;
    word_count = 0;			//清空搜索的字符串
}

void DFA_56()
{
    RetChar();
    //输出
    word[word_count] = '\0';
    fputs("零填充右移位 ", fout);
    fputs(word, fout);
    fputs("\n", fout);
    fprintf(fstdout, "119");
    
    cur_row_cout++;
    all_count++;
    word_count = 0;			//清空搜索的字符串
}

void DFA_57()
{
    //输出
    word[word_count] = '\0';
    fputs("右移位赋值 ", fout);
    fputs(word, fout);
    fputs("\n", fout);
    fprintf(fstdout, "110");
    
    cur_row_cout++;
    all_count++;
    word_count = 0;			//清空搜索的字符串
}

void DFA_58()
{
    RetChar();
    //输出
    word[word_count] = '\0';
    fputs("右移位 ", fout);
    fputs(word, fout);
    fputs("\n", fout);
    fprintf(fstdout, "119");
    
    cur_row_cout++;
    all_count++;
    word_count = 0;			//清空搜索的字符串
}

void DFA_59()
{
    RetChar();
    //输出
    word[word_count] = '\0';
    fputs("大于 ", fout);
    fputs(word, fout);
    fputs("\n", fout);
    
    cur_row_cout++;
    all_count++;
    word_count = 0;			//清空搜索的字符串
}

void DFA_60()
{
    NextCh();
    word[word_count++] = ch;
    if (ch == '=')
    {
        DFA_61();
        return;
    }
    if (ch == '<')
    {
        DFA_62();
        return;
    }
    DFA_65();
}

void DFA_61()
{
    //输出
    word[word_count] = '\0';
    fputs("大于等于 ", fout);
    fputs(word, fout);
    fputs("\n", fout);
    fprintf(fstdout, "118");
    
    cur_row_cout++;
    all_count++;
    word_count = 0;			//清空搜索的字符串
}

void DFA_62()
{
    NextCh();
    word[word_count++] = ch;
    if (ch == '=')
    {
        DFA_63();
        return;
    }
    DFA_64();
}

void DFA_63()
{
    //输出
    word[word_count] = '\0';
    fputs("左移赋值 ", fout);
    fputs(word, fout);
    fputs("\n", fout);
    fprintf(fstdout, "110");
    
    cur_row_cout++;
    all_count++;
    word_count = 0;			//清空搜索的字符串
}

void DFA_64()
{
    RetChar();
    //输出
    word[word_count] = '\0';
    fputs("左移 ", fout);
    fputs(word, fout);
    fputs("\n", fout);
    fprintf(fstdout, "119");
    
    cur_row_cout++;
    all_count++;
    word_count = 0;			//清空搜索的字符串
}

void DFA_65()
{
    RetChar();
    //输出
    word[word_count] = '\0';
    fputs("小于 ", fout);
    fputs(word, fout);
    fputs("\n", fout);
    fprintf(fstdout, "118");
    
    cur_row_cout++;
    all_count++;
    word_count = 0;			//清空搜索的字符串
}

void DFA_66()
{
    NextCh();
    word[word_count++] = ch;
    if (ch == ':')
    {
        DFA_67();
        return;
    }
    ErrorPrint();
}

void DFA_67()
{
    //输出
    word[word_count] = '\0';
    fputs("条件运算符 ", fout);
    fputs(word, fout);
    fputs("\n", fout);
    fprintf(fstdout, "111");
    
    cur_row_cout++;
    all_count++;
    word_count = 0;			//清空搜索的字符串
}

void DFA_68()
{
    NextCh();
    word[word_count++] = ch;
    if (ch == '=')
    {
        DFA_69();
        return;
    }
    DFA_70();
}

void DFA_69()
{
    //输出
    word[word_count] = '\0';
    fputs("不等 ", fout);
    fputs(word, fout);
    fputs("\n", fout);
    fprintf(fstdout, "117");
    
    cur_row_cout++;
    all_count++;
    word_count = 0;			//清空搜索的字符串
}

void DFA_70()
{
    RetChar();
    //输出
    word[word_count] = '\0';
    fputs("非 ", fout);
    fputs(word, fout);
    fputs("\n", fout);
    fprintf(fstdout, "11c");
    
    cur_row_cout++;
    all_count++;
    word_count = 0;			//清空搜索的字符串
}

void DFA_71()
{
    //输出
    word[word_count] = '\0';
    fputs("左中括号 ", fout);
    fputs(word, fout);
    fputs("\n", fout);
    fprintf(fstdout, "11d");
    
    cur_row_cout++;
    all_count++;
    word_count = 0;			//清空搜索的字符串
}

void DFA_73()
{
    //输出
    word[word_count] = '\0';
    fputs("右中括号 ", fout);
    fputs(word, fout);
    fputs("\n", fout);
    fprintf(fstdout, "11d");
    
    cur_row_cout++;
    all_count++;
    word_count = 0;			//清空搜索的字符串
}

void DFA_74()
{
    //输出
    word[word_count] = '\0';
    fputs("左括号 ", fout);
    fputs(word, fout);
    fputs("\n", fout);
    fprintf(fstdout, "11d");
    
    cur_row_cout++;
    all_count++;
    word_count = 0;			//清空搜索的字符串
}

void DFA_75()
{
    //输出
    word[word_count] = '\0';
    fputs("右括号 ", fout);
    fputs(word, fout);
    fputs("\n", fout);
    fprintf(fstdout, "11d");
    
    cur_row_cout++;
    all_count++;
    word_count = 0;			//清空搜索的字符串
}

void DFA_76()
{
    //输出
    word[word_count] = '\0';
    fputs("逗号 ", fout);
    fputs(word, fout);
    fputs("\n", fout);
    fprintf(fstdout, "120");
    
    cur_row_cout++;
    all_count++;
    word_count = 0;			//清空搜索的字符串
}

void DFA_77()
{
    RetChar();
    //输出
    word[word_count] = '\0';
    fputs("点号 ", fout);
    fputs(word, fout);
    fputs("\n", fout);
    fprintf(fstdout, "11d");
    
    cur_row_cout++;
    all_count++;
    word_count = 0;			//清空搜索的字符串
}

void DFA_78()
{
    //输出
    word[word_count] = '\0';
    fputs("左大括号 ", fout);
    fputs(word, fout);
    fputs("\n", fout);
    fprintf(fstdout, "121");
    
    cur_row_cout++;
    all_count++;
    word_count = 0;			//清空搜索的字符串
}

void DFA_79()
{
    //输出
    word[word_count] = '\0';
    fputs("右大括号 ", fout);
    fputs(word, fout);
    fputs("\n", fout);
    fprintf(fstdout, "121");
    
    cur_row_cout++;
    all_count++;
    word_count = 0;			//清空搜索的字符串
}

void DFA_80()
{
    //输出
    word[word_count] = '\0';
    fputs("分号 ", fout);
    fputs(word, fout);
    fputs("\n", fout);
    fprintf(fstdout, "122");
    
    cur_row_cout++;
    all_count++;
    word_count = 0;			//清空搜索的字符串
}

void DFA_83()
{
    NextCh();
    word[word_count++] = ch;
    if (IsNumber(ch))
    {
        DFA_11();
        return;
    }
    DFA_77();
}
