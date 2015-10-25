#include <iostream>
#include <string>
#include <cstdlib>
#include <Windows.h>
using namespace std;

#define SIZEOFINDEX 100000

int log_10(unsigned int exp) {
	int ret = 0;
	while ( exp /= 10 ) ret++;
	return ret;
}

class TABLE {
public:
	TABLE() :count(0), allCount(0) {
	}
	void update(string id) {
		int indexOffset = atoi(id.substr(0, log_10(SIZEOFINDEX)).c_str());
		INDEX::INDEXITEM *p = index[indexOffset].head;
		while ( p->next && p->next->id != id ) p = p->next;
		if ( p->next ) p->next->followersCount++;
		else {
			p->next = new INDEX::INDEXITEM(id, 1, NULL);
			count++;
			index[indexOffset].itemCount++;
		}
		allCount++;
	}
	struct INDEX {
		struct INDEXITEM {
			string id;
			int followersCount;
			INDEXITEM *next;
			INDEXITEM() :id(""), followersCount(0), next(NULL) {
			}
			INDEXITEM(string _id, int _followersCount, INDEXITEM *_next) :id(_id), followersCount(_followersCount), next(_next) {
			};
		} *head;
		int itemCount;
		INDEX() :head(new INDEXITEM), itemCount(0) {
		}
	} index[SIZEOFINDEX];
public:
	int count, allCount;
};

class TABLE *BigVTable;
TABLE::INDEX::INDEXITEM *item[50000000];
int sortProgress = 0;
FILE *pFile;
long long fileOffset = 0, fileLength = 1;

extern "C" __declspec(dllexport) int getProgressPercent1() {
	if(pFile) fileOffset = ftell(pFile);
	else return 1000;
	int ret = 0;
	int val = fileOffset / (fileLength / 1000);
	if ( val < 0 )ret = 0;
	else if ( val > 1000 )ret = 1000;
	else ret = val;
	return ret;
}

extern "C" __declspec(dllexport) int getProgressPercent2() {
	if ( pFile ) fileOffset = ftell(pFile);
	else return 1000;
	int ret = 0;
	int val = fileOffset / (fileLength / 1000);
	ret = val * 0.9 + sortProgress * 0.1;
	if ( ret < 0 )ret = 0;
	else if ( ret > 1000 )ret = 1000;
	return ret;
}

int cmp(const void *a, const void *b) {
	if ( (*(TABLE::INDEX::INDEXITEM **)a)->followersCount < (*(TABLE::INDEX::INDEXITEM **)b)->followersCount )
		return 1;
	else
		return (-1);
}

extern "C" __declspec(dllexport) void getFollowers(char *id, char *srcJsonPath, char *dstJsonPath, int srcJsonCountOfId) {
	try {
		FILE *fp, *fp2;
		fopen_s(&fp, srcJsonPath, "r");
		fopen_s(&fp2, dstJsonPath, "w");
		pFile = fp;
		fseek(fp, 0, SEEK_END);
		fileLength = ftell(fp);
		rewind(fp);
		char buf[40000];
		int j = 0;
		for ( int x = 0; x < srcJsonCountOfId; x++ ) {
			int i = 0;
			while ( (buf[i++] = fgetc(fp)) != '\n' );
			buf[i] = 0;
			string tmp = buf;
			if ( tmp.find(id) != string::npos ) {
				fprintf_s(fp2, "%s", tmp.c_str());
			}
		}
		fclose(fp2);
		pFile = NULL;
		fclose(fp);
	}
	catch ( exception e ) {}
	return;
}

void getFollowersFocus(char *followersOfOneIdJsonPath) {
	FILE *fp;
	fopen_s(&fp, followersOfOneIdJsonPath, "r");
	pFile = fp;
	fseek(fp, 0, SEEK_END);
	fileLength = ftell(fp);
	rewind(fp);
	if ( BigVTable ) delete BigVTable;
	BigVTable = new TABLE();
	char ch;
	while ( (ch = fgetc(fp)) != EOF ) {
		if ( ch != '[' ) continue;
		else {
			char buf[20];
			int i = 0;
			while ( 1 ) {
				ch = fgetc(fp);
				if ( ch != ',' && ch != ']' ) {
					buf[i++] = ch;
				}
				else {
					buf[i] = 0;
					string tid = buf;
					BigVTable->update(tid);
					i = 0;
				}
				if ( ch == ']' ) break;
			}
		}
	}
	return;
}

void sortFollowersFocusAndOutputToFile(char *txtFilePath, int deadlineNum) {
	int itemCount = 0;
	sortProgress = 0;
	for ( int i = 0; i < SIZEOFINDEX; i++ ) {
		TABLE::INDEX::INDEXITEM *p = BigVTable->index[i].head;
		while ( p->next ) {
			if ( p->next->followersCount > deadlineNum ) {
				item[itemCount++] = p->next;
			}
			p = p->next;
		}
		sortProgress = i * 1000 / SIZEOFINDEX;
	}
	qsort((TABLE::INDEX::INDEXITEM **)item, itemCount, sizeof(TABLE::INDEX::INDEXITEM *), cmp);
	FILE *fp;
	fopen_s(&fp, txtFilePath, "w");
	fprintf_s(fp, "ÅÅÃû\tÎ¢²©ID\t·ÛË¿Êý\n");
	for ( int i = 0; i < itemCount; i++ ) {
		fprintf_s(fp, "%d\t%s\t%d\n", i, item[i]->id.c_str(), item[i]->followersCount);
	}
	pFile = NULL;
	fclose(fp);
}

extern "C" __declspec(dllexport) void analyseFollowersFocus(char *followersOfOneIdJsonPath, char *txtFilePath, int deadlineNum) {
	try {
		getFollowersFocus(followersOfOneIdJsonPath);
		sortFollowersFocusAndOutputToFile(txtFilePath, deadlineNum);
		
	}
	catch ( exception e ) {}
	return;
}

int main() {
	/*getFollowers("1244589914",
				 "E:\\Weibo\\relsemple.json",
				 "E:\\BSLWfollowersFocus.json",
				 756503);*/
	getFollowersFocus("E:\\Weibo\\followersList_1244589914.json");
	sortFollowersFocusAndOutputToFile("E:\\Weibo\\followersFocus_1244589914.txt", 500);
	return 0;
}